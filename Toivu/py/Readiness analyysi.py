#!/usr/bin/env python
# coding: utf-8

# # Readiness analyysi
# 22.2.2021, Sakari Lukkarinen<br>
# Metropolia UAS<br>
# 
# Perustuu esimerkkeihin:
# 
# - [Kubioscloud example for Authorization code grant](https://bitbucket.org/kubios/workspace/snippets/4X95xd/kubioscloud-example-for-authorization-code)
# - [KubiosCloud Client](https://bitbucket.org/kubios/kub-kubioscloud-cli/src/master/)
# 
# Katso myös: 
# - [KubiosCloud API Documentation](https://analysis.kubioscloud.com/v1/portal/documentation/apis.html#kubioscloud-api-reference)

# ## Asetukset
# 
# Luetaan tarvittavat kirjastot.

# In[2]:


#!/usr/bin/env python3
from pprint import pprint
import pandas as pd
import requests


# ## Avaimet
# 
# Avaimet löytyvät työtilan dokumenteista > Kubios Cloud > [03. Kubios Cloudin käyttöönotto.pdf](https://oma.metropolia.fi/delegate/download_workspace_attachment/7672045/03.%20Kubios%20Cloudin%20käyttöönotto.pdf).
# 
# KubiosCloud API dokumentaation kohdassa [Analytics Endpoint](https://analysis.kubioscloud.com/v1/portal/documentation/apis.html#analytics-endpoint) on kerrottu, että kaikki tämän kohdan toiminnot vaativat toimiakseen APIKEY autentikoinnin. Siksi alla on APIKEY -avaimet.

# In[3]:


APIKEY = "pbZRUi49X48I56oL1Lq8y8NDjq6rPfzX3AQeNo3a"
CLIENT_ID = "3pjgjdmamlj759te85icf0lucv"
CLIENT_SECRET = "111fqsli1eo7mejcrlffbklvftcnfl4keoadrdv1o45vt9pndlef"

LOGIN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/login"
TOKEN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/oauth2/token"
REDIRECT_URI = "https://analysis.kubioscloud.com/v1/portal/login"


# ## Sisäänpääsyvaltuudet
# 
# Seurataan suoraan esimerkkejä kuinka saadaan sisäänpääsyvaltuudet (access token). Näytetään valtuudet pprint() komennolla.

# In[4]:


response = requests.post(
    url = TOKEN_URL, 
    data = {'client_id': CLIENT_ID, 'grant_type': 'client_credentials'}, 
    auth = (CLIENT_ID, CLIENT_SECRET))

access_token = response.json()["access_token"]
pprint(access_token)


# ## Avataan istunto (session)
# 
# Muodostetaan `requests` istunto, jolle on annettu vaadittava API avain ja sisäänpääsyvaltuudet.

# In[5]:


headers = {
    "Authorization": "Bearer {}".format(access_token),
    "X-Api-Key": APIKEY,
}
reqs = requests.Session()
reqs.headers.update(headers)
pprint(headers)


# ## Muodosta data
# 
# Luetaan esimerkki PPI datat kahdesta tekstitiedostosta, jotka on tallennettu [Polar Sensor Logger](https://play.google.com/store/apps/details?id=com.j_ware.polarsensorlogger&hl=en&gl=US) sovelluksella ja [Polar OH1](https://www.polar.com/fi/tuotteet/lisatarvikkeet/oh1-optinen-sykesensori) optisella sykesensorilla.

# In[7]:


# Read first data in
data1 = pd.read_csv('Polar_OH1_87179C26_20210212_223309_PPI.txt', sep = ';')
rr1 = data1['PP-interval [ms]'].squeeze()
# print(rr1.head())

# Read second data in
data2 = pd.read_csv('Polar_OH1_87179C26_20210217_230450_PPI.txt', sep = ';')
rr2 = data2['PP-interval [ms]'].squeeze()
# print(rr2.head())

data_set = {"format": "RR",
  "data": [
    { "values": rr1.head(3*60).to_list() },
    { "values": rr2.head(3*60).to_list() } ] }
# pprint(data_set)


# In[11]:


# Alla on käsin muodostettu data, jos yllä oleva koodi ei toimi.
# data_set =  {"format": "RR", 
#            "data": [{"values": [1135, 927, 905, 892, 880, 887, 908, 953, 1007, 1060]}, 
#                     {"values": [968, 954, 933, 926, 943, 945, 956, 932, 922, 931]}]}
# pprint(data_set)


# ## Readiness analyysi
# 
# Kutsutaan KubiosCloudin readiness analyysia käyttäen muodostettua dataa. Data annetaan `requests` metodin `json`kenttään. Tuloksena saadaan `response`, joka näytetään json-muodossa.

# In[8]:


# Make the readiness analysis with the given data
response = reqs.request('POST', 
                        url = "https://analysis.kubioscloud.com/v1/analytics/readiness",
                        params = None, 
                        json = data_set)
pprint(response.json())


# ## Muunnetaan tulos DataFrameksi
# 
# Lopuksi muunnetaan tulos pandasin DataFrameksi [json_normalize](https://pandas.pydata.org/pandas-docs/stable/reference/api/pandas.json_normalize.html) metodilla ja näytetään se [transpose](https://pandas.pydata.org/pandas-docs/stable/reference/api/pandas.DataFrame.transpose.html)-muodossa.

# In[13]:


out = pd.json_normalize(response.json())
pprint(out.T)


# In[ ]:




