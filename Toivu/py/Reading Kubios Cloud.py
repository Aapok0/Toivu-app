#!/usr/bin/env python
# coding: utf-8

# # Reading Kubios Cloud
# 18.2.2021, Sakari Lukkarinen<br>
# Metropolia UAS<br>
# 
# Based on: https://bitbucket.org/kubios/workspace/snippets/4X95xd/kubioscloud-example-for-authorization-code
# 
# See also: [Kubios Cloud API](https://analysis.kubioscloud.com/v1/portal/documentation/apis.html#kubioscloud-api-reference)

# ## Setup

# In[1]:


#!/usr/bin/env python3
"""Kubioscloud example for Authorization code grant"""
import base64
import logging
import re
import uuid
from pprint import pprint

import requests

import matplotlib.pyplot as plt
import numpy as np
import urllib


# In[2]:


USERNAME = "sakari.lukkarinen@metropolia.fi"
PASSWORD = "....."
CLIENT_ID = "74571pdhuc7vvak4tl45uts8u8"

LOGIN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/login"
TOKEN_URL = "https://kubioscloud.auth.eu-west-1.amazoncognito.com/oauth2/token"
REDIRECT_URI = "https://analysis.kubioscloud.com/v1/portal/login"

USER_AGENT = "TestApp 1.0"  # FIXME: Use unique name for your application


# ## Opening a session

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


# In[4]:


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


# In[5]:


# What are the possible tokens?
tokens.keys()


# In[6]:


# When does this token expire?
tokens['expires_in']


# ## Reading info

# ### User details

# In[7]:


log.info("Query for user details to test obtained credentials")
response = session.get(
    "https://analysis.kubioscloud.com/v1/user/self",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# In[8]:


# Use the team_id as user id
USER_ID = '22bb26ba-7a5a-4bd5-b6be-80fe9dfe9db2'
# USER_ID = "self"
BASE_URL = "https://analysis.kubioscloud.com"

GET_USER_INFORMATION = BASE_URL + "/v1/user/{:}".format(USER_ID)
GET_USER_AVATAR_IMAGE = BASE_URL + "/v1/user/{:}/avatar".format(USER_ID)
SET_USER_AVATAR_IMAGE = BASE_URL + "/v1/user/{:}/avatar".format(USER_ID)
UPDATE_USER_INFORMATION = BASE_URL + "/v1/user/{:}".format(USER_ID)

INIT_MEASUREMENT_SESSION = BASE_URL + "/v2/measure/{:}/session".format(USER_ID)


# ## List of measurements
# 
# There are more options, see: [Get list of measurements](https://analysis.kubioscloud.com/v1/portal/documentation/apis.html#get-list-of-measurements)

# In[10]:


log.info("Get list of measurements")
response = session.get(
    "https://analysis.kubioscloud.com/v2/measure/self/session",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# In[11]:


log.info("List measure subject")
response = session.get(
    "https://analysis.kubioscloud.com/v2/measure/self/subject",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Get measurement details

# In[12]:


log.info("Get measure details")
measure_id = '98213fce-4634-40b2-80e8-d7b1f17d7a3f'
# measure_id = 'e4f732bc-734a-44c8-be17-5ebab448ebb3'
response = session.get(
    "https://analysis.kubioscloud.com/v2/measure/self/session/" + measure_id,
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Get Team information
# 
# NOTE: This is possible only for admins.

# In[14]:


log.info("Get Team Information")
response = session.get(
    "https://analysis.kubioscloud.com/v1/team/team/22bb26ba-7a5a-4bd5-b6be-80fe9dfe9db2?members=yes&invites=yes",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Get (Team Member) User Information

# In[16]:


log.info("Get User Information")
USER_ID = 'b6e7a621-2d73-4a3e-955e-5dd5e3f10976'

response = session.get(
    "https://analysis.kubioscloud.com/v1/user/" + USER_ID,
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Get list of measurements for selected user

# In[19]:


log.info("Get list of measurements for a user")

response = session.get(
    "https://analysis.kubioscloud.com/v2/measure/" + USER_ID + "/session?from=2021-02-10",
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Get all results for a selected user

# In[21]:


log.info("Get results")
response = session.get(
    "https://analysis.kubioscloud.com/v1/result/" + USER_ID,
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Select one measure for details

# In[22]:


log.info("Get measure details")
measure_id = 'fd4534e8-2944-40e8-8028-dadbf88fda4c'
#measure_id = 'e4f732bc-734a-44c8-be17-5ebab448ebb3'
response = session.get(
    "https://analysis.kubioscloud.com/v2/measure/self/session/" + measure_id,
    headers={"Authorization": tokens["id_token"], "User-Agent": USER_AGENT},
)
pprint(response.json())


# ## Read the data related to measurement

# In[24]:


data_url = 'https://ew1-kub-prd-content.s3.amazonaws.com/measure/user-b6e7a621-2d73-4a3e-955e-5dd5e3f10976/session-fd4534e8-2944-40e8-8028-dadbf88fda4c/channel-000/final/data?AWSAccessKeyId=ASIA6DPVPCLZTK6LIEBJ&Signature=akMNNAU%2BWfJNlNHNTdzYo6fgwIY%3D&x-amz-security-token=IQoJb3JpZ2luX2VjEGgaCWV1LXdlc3QtMSJIMEYCIQC7HsmF3cbAVU8phlSDyq5hAZlePi81PYies8p3j8HaHQIhAIMxv1ShdlqhcGiCmBskocUj4zjbcQQxHUzt%2Bb7ODyfiKv8BCHAQARoMOTY5NTY2Nzg2MjkxIgz%2BrKt%2F89pFNP9dj2cq3AFuQ5wcM2Rqr%2FEwFDqZD759ug6wvvbm12mU19MyQRbvw9G34Ta9i4LJkz8kbT%2FJsIWTF5svlU5cek9Acp9h7JwMqcklTsi2zu115Bl3eVr6HbRQVkdMvLLN3iHERmZPpkm%2Fxkcjlo7GHrgkjS0tRL78gCbSGdUiTbm62o1JZY2yIA%2FwomnKfatRdw1F17Z63cU0Nk4DcbHxhn1F85%2Fi2oB%2Ff49UQ%2FtTSV%2FoHzUNkLcvT9sXZJ%2FeUj3cxY1EX2nOz9LQGOad%2BgiX%2FMESLBhYO304Jj23UmjJg%2FHD%2FgeBMOqpuIEGOt8BwP%2Fh50cRZtZxfmP4gz7ktPWPAwOyirWzTzUUVaKpnIhEztXsIs4oY0wcf%2FTddlfwrQKCn7UcoaCqDYVGPY9SKMlI8UHP8N8jmmyGunqb7zvyT31M5ImMQm0kcMFGJKT%2BbmFYTaeFLmo7vhbgAGC3jESkLdHC0ehLus%2FLddQs52f9x3%2BhPv9fXuFzpNEoefeHxn1tCgMWDkO4iRcIe0XrtDNeGteVFGGLsAbE%2F%2FLvSg7DE51TnFP4c5TRSTJCwOYcE0OIOVYwKVM9NVVI3z0AEyzhnSqZAQxcBgpCjvWtDA%3D%3D&Expires=1613639539'
data = urllib.request.urlopen(data_url)
byte = data.read(2)
rr = []
while byte:
    rr.append(int.from_bytes(byte, byteorder = "little"))
    byte = data.read(2)
rr = np.array(rr)


# ### Show the RR plot

# In[25]:


x = np.cumsum(rr)/1000
plt.plot(x, rr)
plt.xlabel('time (s)')
plt.ylabel('RR (ms)')
plt.grid()
plt.show()


# ### Show the Heart rate plot

# In[26]:


bpm = 60*1000/rr
plt.plot(x, bpm)
plt.xlabel('time (s)')
plt.ylabel('Heart rate (BPM)')
plt.grid()
plt.show()

