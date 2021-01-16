import urllib2
import urllib
import re
import subprocess

start = urllib2.build_opener()
start.addheaders = [('User-Agent', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/34.0.1847.116 Chrome/34.0.1847.116 Safari/537.36')]
start.addheaders.append(('Cookie', 'enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1626280002%3Bi%3A3%3Bi%3A2%3B%7D; PHPSESSID=qrfk4e2n9p1rfsv2fflkfjcem6; __utma=144401761.862608985.1437489799.1437489799.1437489799.1; __utmb=144401761.3.10.1437489799;__utmc=144401761; __utmt=1; __utmz=144401761.1437489799.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'))

response = start.open('http://www.enigmagroup.org/missions/captcha/1/image.php')
write_to_html = response.read()

file_handle = open('captcha.png', 'wb')
file_handle.write(write_to_html)
file_handle.close

file_handle = open('captcha.png', 'rb')
theCaptcha = subprocess.Popen(['gocr -i captcha.png'], shell=True, stdout=subprocess.PIPE).communicate()[0]
file_handle.close

print "debug--the captcha: " + theCaptcha

theCaptcha = theCaptcha.replace('\n', '')
theCaptcha = theCaptcha.replace(' ', '')
theCaptcha = theCaptcha.replace(',', '')
theCaptcha = theCaptcha.replace('\'', '')

values = {'answer':theCaptcha,'submit':'true'}

print "your captcha output: " + theCaptcha

post_data = urllib.urlencode(values)
start.addheaders.append(('Referer', 'http://www.enigmagroup.org/missions/captcha/1/image.php'))
response = start.open('http://www.enigmagroup.org/missions/captcha/1/image.php', post_data)

print post_data

runme = open('result.html','w')
runme.write(response.read())
runme.close
