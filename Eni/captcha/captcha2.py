import requests
from PIL import Image
from pytesser import *
import subprocess

cookies = {'enigmafiedV4': 'enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1626280002%3Bi%3A3%3Bi%3A2%3B%7D; PHPSESSID=qrfk4e2n9p1rfsv2fflkfjcem6; __utma=144401761.862608985.1437489799.1437489799.1437489799.1; __utmb=144401761.3.10.1437489799;__utmc=144401761; __utmt=1; __utmz=144401761.1437489799.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'}
url = 'http://www.enigmagroup.org/missions/captcha/2/image.php'
headers = {'referer': url}

s = requests.Session()
r = s.get(url, cookies=cookies)
with open('temp.png', 'w') as f:
    f.write(r.content)

im = Image.open('temp.png')
im2 = Image.new("P", im.size, 255)
im3 = im2.load()

for i in range(0,im.size[0]):
    for j in range(0,im.size[1]):
        pixel = im.getpixel((i,j))
        if pixel == 1 or pixel > 58:
            im3[i,j] = 1

im2.save('result.png', 'PNG')

answer = image_to_string(im2)
print answer

data = {'answer': answer, 'submit': 'true'}
r = s.post(url, headers=headers, cookies=cookies, data=data)
print r.content
