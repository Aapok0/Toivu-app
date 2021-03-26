#!/usr/bin/env python
# coding: utf-8

# # Polar OH1 Datastream
# 23.2.2021, Sakari Lukkarinen<br>
# Metropolia University of Applied Sciences<br>
# 

# - [Polar Device Stream ECG](https://github.com/pareeknikhil/biofeedback/tree/master/Polar%20Device%20Data%20Stream/ECG)
# - [Bleak documentation](https://bleak.readthedocs.io/en/latest)
# - [Polar SDK](https://www.polar.com/en/developers/sdk)
#     - [Technical documentation](https://github.com/polarofficial/polar-ble-sdk/tree/master/technical_documentation)
#     - [Polar OH1 optinen sykesensori](https://www.polar.com/fi/tuotteet/lisatarvikkeet/oh1-optinen-sykesensori)
# 

# In[1]:


# %matplotlib inline
import asyncio
import nest_asyncio
import signal
import pandas as pd
import matplotlib.pyplot as plt
from datetime import datetime

#!pip install bleak
from bleak import BleakClient
# from bleak.uuids import uuid16_dict

nest_asyncio.apply()


# In[2]:


# uuid16_dict = {v: k for k, v in uuid16_dict.items()}

## UUID for model number
MODEL_NBR_UUID = "00002a24-0000-1000-8000-00805f9b34fb"

## UUID for manufacturer name
MANUFACTURER_NAME_UUID = "00002a29-0000-1000-8000-00805f9b34fb"

## UUID for battery level
BATTERY_LEVEL_UUID = "00002a19-0000-1000-8000-00805f9b34fb"

## UUID for connection establsihment with device
PMD_SERVICE = "FB005C80-02E7-F387-1CAD-8ACD2D8DF0C8"

## UUID for Request of stream settings 
PMD_CONTROL = "FB005C81-02E7-F387-1CAD-8ACD2D8DF0C8"

## UUID for Request of start stream
PMD_DATA = "FB005C82-02E7-F387-1CAD-8ACD2D8DF0C8"

## UUID for Request of ECG Stream
# ECG_WRITE = bytearray([0x02, 0x00, 0x00, 0x01, 0x82, 0x00, 0x01, 0x01, 0x0E, 0x00])
# START_PPG_STREAM = bytearray([0x02, 0x01, 0x00, 0x01, 0xC8, 0x00, 0x01, 0x01, 0x10, 0x00, 0x02, 0x01, 0x08, 0x00])
START_PPI_STREAM = bytearray([0x02, 0x03])
STOP_PPI_STREAM = bytearray([0x03, 0x03])

## For Polar H10  sampling frequency ##
# ECG_SAMPLING_FREQ = 130


# In[25]:


## Keyboard Interrupt Handler
def keyboardInterrupt_handler(signum, frame):
    print("Keyboard interrupt received...")
    print("----------------Recording stopped------------------------")
    exit()

def convert_to_unsigned_long(data, offset, length):
    return int.from_bytes(
        bytearray(data[offset : offset + length]), byteorder="little", signed=False,
    )

def convert_array_to_signed_int(data, offset, length):
    return int.from_bytes(
        bytearray(data[offset : offset + length]), byteorder="little", signed=True,
    )

# Plot and save PPI data
def plot_and_save_data(time_started):
    pd.set_option('precision', 0)
    
    # Convert to Pandas Series, take only the tail of the data and reset index
    ppi = pd.Series(ppi_session_data).tail(record_length).reset_index(drop = True)
    
    # Plot the data
    plt.figure()
    ppi.plot.line(style = '.-')
    plt.xlabel('Index')
    plt.ylabel('PPI (ms)')
    plt.title('PPI data')
    plt.grid()
    plt.show()
    
    # Calculate descriptive statistics
    print('Descriptive statistics:')
    print(ppi.describe())
    
    # Save to file, use time_started in naming
    filename = time_started.strftime('%Y-%m-%d_%H%M.txt')
    ppi.to_csv(filename, header = False, index = False)
    print('\nData saved to file: ', filename)
    
## Bit conversion of the binary stream
def data_conv(sender, data):
    # 0x03 = PPG type
    if data[0] == 0x03:
        # First 8 bytes are for time stamp
        timestamp = convert_to_unsigned_long(data, 1, 8)
        
        # 0x00 = PPI dataframe
        if data[9] == 0x00:
            # Rest are samples in 6 bytes chunks
            samples = data[10:]
            offset = 0
            step = 6
            while offset < len(samples):
                # Heart rate (1 byte)
                hr = samples[offset]
                # Peak-to-peak (2 bytes)
                pp = int.from_bytes(samples[offset+1:offset+3], 'little')
                # Error estimate (2 bytes)
                err_est = int.from_bytes(samples[offset+3:offset+5], 'little')
                # Blocker info (1 byte)
                blocker = samples[offset+5]
                print("{:4.0f}".format(pp), end = " ")
                offset += step
                ppi_session_data.append(pp)
    
## Aynchronous task to start the data stream for ECG ##
async def run(client):

    await client.is_connected()
    print("---------Device connected--------------")

    manufacturer_name = await client.read_gatt_char(MANUFACTURER_NAME_UUID)
    print("Manufacturer:  {0}".format("".join(map(chr, manufacturer_name))))

    model_number = await client.read_gatt_char(MODEL_NBR_UUID)
    print("Model Number:  {0}".format("".join(map(chr, model_number))))

    battery_level = await client.read_gatt_char(BATTERY_LEVEL_UUID)
    print("Battery Level: {0}%".format(int(battery_level[0])))

    att_read = await client.read_gatt_char(PMD_CONTROL)
    if att_read[0] == 0x0F:
        features = att_read[1]
        print('ECG supported:', features&1 != 0)
        print('PPG supported:', features&2 != 0)
        print('ACC supported:', features&4 != 0)
        print('PPI supported:', features&8 != 0)
    
    print('\nRelax for {:} seconds '.format(relaxation_length), end = '')
    for i in range(relaxation_length):
        await asyncio.sleep(1)
        print('.', end = '')

    # Start PPI stream
    await client.write_gatt_char(PMD_CONTROL, START_PPI_STREAM)
        
    ## Data will be collected by data_conv() function everytime
    ## the client notifies that it has data read
    await client.start_notify(PMD_DATA, data_conv)

    print('\nStart recording: ', end = "")
    # Counting for 10 extra seconds so that OH1 gets ready.
    for i in range(5, 0, -1):
        print(i, end = " ")
        await asyncio.sleep(2)
    print('Go!')
    
    time_started = datetime.now()
    
    print("\nCollecting PPI data for {:} seconds:".format(record_length))  
    for i in range(record_length):
        await asyncio.sleep(1)

    ## Stop the stream once data is collected
    print("\nStopping...")
    
    await client.write_gatt_char(PMD_CONTROL, STOP_PPI_STREAM)
    
    print("Connection closed.")
    
    plot_and_save_data(time_started)
    
async def main(ADDRESS):
    try:
        async with BleakClient(ADDRESS) as client:
            signal.signal(signal.SIGINT, keyboardInterrupt_handler)
            tasks = [asyncio.ensure_future(run(client))]
            await asyncio.gather(*tasks)
    except:
        print('Nope.')
        pass


# In[26]:


## This is the device MAC ID, please update with your device ID
ADDRESS = "A0:9E:1A:87:17:9C"

# Data will be collected to this list
ppi_session_data = []

# Length of recorded data in seconds
record_length = 180

# Length of relaxation period in seconds
relaxation_length = 30

# Start asynchronous events and run loop
loop = asyncio.new_event_loop()
asyncio.set_event_loop(loop)
loop.run_until_complete(main(ADDRESS))


# In[ ]:




