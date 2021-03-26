#!/usr/bin/env python
# coding: utf-8

# # List devices
# 23.2.2021, Sakari Lukkarinen<br>
# Metropolia University of Applied Sciences<br>
# 
# See: https://bleak.readthedocs.io/en/latest/scanning.html#

# ## List devices

# In[41]:


# !pip install nest_asyncio
import nest_asyncio
nest_asyncio.apply()

import asyncio
from bleak import BleakScanner

devices = []
async def run():
    devices = await BleakScanner.discover()
    for d in devices:
        print(d)
        print(d.address)
        print()

loop = asyncio.get_event_loop()
loop.run_until_complete(run())


# ## Show details for selected device
# 
# **Note: Remember to change the address!**

# In[44]:


# Change the address!!!
address = "A0:9E:1A:87:17:9C"

MANUFACTURER_NAME_UUID = "00002a29-0000-1000-8000-00805f9b34fb"
MODEL_NBR_UUID = "00002a24-0000-1000-8000-00805f9b34fb"
BATTERY_LEVEL_UUID = "00002a19-0000-1000-8000-00805f9b34fb"
PMD_CONTROL = "FB005C81-02E7-F387-1CAD-8ACD2D8DF0C8"

async def run(address):
    client = BleakClient(address)
    try:
        await client.connect()
        manufacturer = await client.read_gatt_char(MANUFACTURER_NAME_UUID)
        print("Manufacturer:  {0}".format("".join(map(chr, manufacturer))))

        model_number = await client.read_gatt_char(MODEL_NBR_UUID)
        print("Model Number:  {0}".format("".join(map(chr, model_number))))

        battery = await client.read_gatt_char(BATTERY_LEVEL_UUID)
        print("Battery level: {0}%".format(int(battery[0])))
        
        att_read = await client.read_gatt_char(PMD_CONTROL)
        if att_read[0] == 0x0F:
            features = att_read[1]
            print('ECG supported:', features&1 != 0)
            print('PPG supported:', features&2 != 0)
            print('ACC supported:', features&4 != 0)
            print('PPI supported:', features&8 != 0)

    except Exception as e:
        print(e)
    finally:
        await client.disconnect()

loop = asyncio.get_event_loop()
loop.run_until_complete(run(address))


# In[ ]:




