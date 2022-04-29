

from cryptography.fernet import Fernet

key = Fernet.generate_key()

cipher = Fernet(key)


cipher = Fernet(key)

with open('symmetric_key','wb') as k:
    skey = k.write(key)


myfile = open('mysecretdata','rb')
myfiledata= myfile.read()


encrypted_data = cipher.encrypt(myfiledata)
edata = open('encrypted_file','wb')
edata.write(encrypted_data)
