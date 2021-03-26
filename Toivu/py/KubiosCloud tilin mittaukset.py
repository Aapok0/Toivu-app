#!/usr/bin/env python
# coding: utf-8

# # KubiosCloud tilin mittaukset
# 
# 22.2.2021, Sakari Lukkarinen<br>
# Metropolia UAS<br>
# 
# Koodi perustuu [KubiosCloud Example for authorization code](https://bitbucket.org/kubios/workspace/snippets/4X95xd/kubioscloud-example-for-authorization-code). 
# 
# Lisäkomentoja on haettu dokumentista [Kubios Cloud API Reference](https://analysis.kubioscloud.com/v1/portal/documentation/apis.html#kubioscloud-api-reference)

# ## Asetukset
# 
# Luetaan tarvittavat kirjastot.

# In[1]:


#!/usr/bin/env python3
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd

from pprint import pprint
from datetime import datetime

import logging
import urllib
import uuid
import os

import requests


# ## Käyttäjätunnukset
# 
# Vaihda alle omat KubiosCloud (tai Kubios HRV) tunnus ja salasana. 
# 
# Muut identifikaatiot ja URLit löytyvät työtilan dokumenteista > Kubios Cloud > [03. Kubios Cloudin käyttöönotto.pdf](https://oma.metropolia.fi/delegate/download_workspace_attachment/7672045/03.%20Kubios%20Cloudin%20käyttöönotto.pdf).

# In[2]:


USERNAME = "sakari.lukkarinen@metropolia.fi"
PASSWORD = ""
CLIENT_ID = "74571pdhuc7vvak4tl45uts8u8"

LOGIN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/login"
TOKEN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/oauth2/token"
REDIRECT_URI = "https://analysis.kubioscloud.com/v1/portal/login"

USER_AGENT = "TestApp 1.0"  # FIXME: Use unique name for your application


# ## Sisäänpääsyvaltuudet
# 
# Seurataan suoraan esimerkin koodia.

# In[3]:


logging.basicConfig(format="%(asctime)-15s [%(levelname)s]: %(message)s")

log = logging.getLogger(__name__)
log.setLevel(logging.INFO)

csrf = str(uuid.uuid4())

login_data = {
    "client_id": CLIENT_ID,
    "redirect_uri": REDIRECT_URI,
    "username": USERNAME,
    "password": PASSWORD,
    "response_type": "code",
    "access_type": "offline",
    "_csrf": csrf,
}


# ## Avataan istunto
# 
# Käytetään istunnon avaamisessa sisäänpääsyvaltuuksia.

# In[4]:


session = requests.session()

log.info("Authenticating to '%r' with client_id: %r", LOGIN_URL, CLIENT_ID)
login_response = session.post(
    LOGIN_URL,
    data=login_data,
    allow_redirects=False,
    headers={"Cookie": f"XSRF-TOKEN={csrf}", "User-Agent": USER_AGENT},
)
assert (
    login_response.status_code == 302
), f"Status: {login_response.status_code}, Authentication failed."
code = login_response.headers["Location"].split("=")[1]
log.info("Got code: %r", code)


# In[5]:


log.info("Exchanging code to tokens")
exch_data = {
    "client_id": CLIENT_ID,
    "code": code,
    "redirect_uri": REDIRECT_URI,
    "grant_type": "authorization_code",
}
exch_response = session.post(
    TOKEN_URL, data=exch_data
)
log.info("Status code %r", exch_response.status_code)
tokens = exch_response.json()


# ## Luetaan data

# ### Käyttäjän tiedot
# 
# Luetaan ensiksi käyttäjän tiedot. Koodi on suoraan esimerkistä.

# In[6]:


log.info("Query for user details to test obtained credentials")
response = session.get(
    "https://analysis.kubioscloud.com/v1/user/self",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
user_info = response.json() 
pprint(user_info)


# ## Lue kaikki mittaustulokset
# 
# Luetaan kaikki käyttäjän tallentamat mittaustulokset 

# In[7]:


log.info("Get all results")
response = session.get(
    "https://analysis.kubioscloud.com/v1/result/self",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)

import json
results = response.json()


# ### Tarkastele ensimmäistä mittaustulosta
# 
# Valitaan listalta ensimmäinen mittaustulos ja näytetään se.

# In[8]:


pprint(results['results'][0])


# ### Tarkastele viimeistä mittaustulosta
# 
# Valitaan listalta viimeinen mittaustulos ja näytetään se.

# In[9]:


pprint(results['results'][-1])


# ## Read all measurements and store them to subfolder rr_data

# Tehdään alihakemisto `rr_data`, jonne tallennetaan kaikki mittaustiedostot. Jos hakemisto on jo olemassa, tiedotetaan käyttäjälle.

# In[10]:


try: 
    os.makedirs('rr_data')
    print('Luotiin hakemisto: rr_data.')
except:
    print('rr_data hakemisto on jo olemassa')


# Käydään kaikki tulokset läpi. Luetaan r kentästä milloin mittaus on tallennettua (=daily_result) ja siihen liittyvä measure_id. Näiden perusteella luetaan itse mittausdata ja tallennetaan mittausdatat rr_data kansioon päivämäärän mukaan.

# In[12]:


for r in results['results']:
    
    # Lue milloin mittaus oli luotu
    time_stamp = r['create_timestamp']
    
    # Muunna teksti datetime objektiksi
    t = datetime.strptime(time_stamp[:16], '%Y-%m-%dT%H:%M')
    
    # Muodosta mittausajasta (t) tiedostonimi 
    file_name = t.strftime('%Y-%m-%d %H%M.txt')
    
    measure_id = r['measure_id']
    
    # Näytä measure_id ja file_name
    print(measure_id, '==>', file_name)
    
    # Lue measure_id liittyvät tarkemmat tiedot
    response = session.get(
        "https://analysis.kubioscloud.com/v2/measure/self/session/" + measure_id,
        headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
    )
    
    # Lue data_url, josta löytyy itse mittaustulos
    data_url = response.json()['measure']['channels'][0]['data_url']
    
    # Avaa data_url lukua varten
    data = urllib.request.urlopen(data_url)
    
    # Lue data 2 tavua kerrallaan ja muunna data listaksi
    byte = data.read(2)
    rr = []
    while byte:
        
        # Muunna tavut kokonaisluvuiksi ja lisää listaan rr
        rr.append(int.from_bytes(byte, byteorder = "little"))
        
        # Lue seuraavat 2 tavua
        byte = data.read(2)
    
    # Muunna lista pandas Series objektiksi
    rr = pd.Series(rr)
    
    # Tallenna tulokset tiedostoon
    rr.to_csv('./rr_data/' + file_name, index = False, header = False)


# ### Näytä viimeisimmän mittauksen rr-data

# In[13]:


x = np.cumsum(rr)/1000
plt.plot(x, rr)
plt.xlabel('time (s)')
plt.ylabel('RR (ms)')
plt.grid()
plt.show()


# ### Näytä viimeisimmän mittauksen syke

# In[14]:


bpm = 60*1000/rr
plt.plot(x, bpm)
plt.xlabel('time (s)')
plt.ylabel('Heart rate (BPM)')
plt.grid()
plt.show()


# In[ ]:




