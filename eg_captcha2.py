import Image
import urllib2
import pytesser

session = 'PHPSESSID=14pu3f74ac8h8nq8aumsvh7cf0;enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1639928348%3Bi%3A3%3Bi%3A2%3B%7D'

def download_photo(filename):
    file_path = "%s%s" % ("C:\DUMP_SPACE\\", filename)
    downloaded_image = file(file_path, "wb")

    req = urllib2.Request('http://www.enigmagroup.org/missions/captcha/2/image.php')
    req.add_header('Cookie', session)
    image_on_web = urllib2.urlopen(req)
    while True:
        buf = image_on_web.read()
        if len(buf) == 0:
            break
    downloaded_image.write(buf)

    downloaded_image.close()
    image_on_web.close()
    return file_path

while 1:
    download_photo('image.png')
    im = Image.open('C:\DUMP_SPACE\image.png')
    rgb = im.load()
    for i in range(im.size[1]):
        for j in range(im.size[0]):
            if rgb[j,i] != 1:
                rgb[j,i] = 0
    im.save('image.png')
    x = 1
    im.transform((im.size[0]/x, im.size[1]/x), Image.EXTENT, (0,0,im.size[0],im.size[1])).save('image.png')
    answer = pytesser.image_to_string(Image.open('image.png'))
    answer = answer.replace('~\\/','V').replace('E','6').repalce('H\'','F').replace('\n','')
    print answer

    req = urllib2.Request('http://www.enigmagroup.org/missions/captcha/2/image.php', 'answer='+answer+'&submit=true')
    req.add_header('Referer','http://www.enigmagroup.org/missions/captcha/2/image.php')
    req.add_header('Cookie',session)
    page = urllib2.urlopen(req).read()
    print page
    if page.find('Sorry') ==-1:
        break
