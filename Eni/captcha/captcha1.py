import urllib2, re
import urllib, os, subprocess, time, base64

opener = urllib2.build_opener()
continue_loop = True
while True:
    opener.addheaders = [('User-Agent', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0')]
    opener.addheaders.append(('Cookie', 'enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1626280002%3Bi%3A3%3Bi%3A2%3B%7D; PHPSESSID=qrfk4e2n9p1rfsv2fflkfjcem6; __utma=144401761.862608985.1437489799.1437489799.1437489799.1; __utmb=144401761.3.10.1437489799;__utmc=144401761; __utmt=1; __utmz=144401761.1437489799.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'))
    opener.addheaders.append(('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'))
    opener.addheaders.append(('Accept-Language', 'en-US,en;q=0.5'))
    opener.addheaders.append(('Accept-Encoding', 'gzip, deflate'))
    opener.addheaders.append(('DNT', '1'))
    opener.addheaders.append(('Connection', 'Keep-Alive'))
    response = opener.open('http://www.enigmagroup.org/missions/captcha/1/image.php','')
    html = response.read()
    #regex = r'data:image/png;base64,(.*)" /><br><br>'
    #result = re.search(regex, html)
    #result = result.group(1)
    #result = base64.b64decode(result)
    file_handle = open('captcha.png', 'wb')
    file_handle.write(html)
    file_handle.close

    file_handle = open('captcha.png', 'rb')
    result = subprocess.Popen(['gocr -i captcha.png'], shell=True, stdout=subprocess.PIPE).communicate()[0]
    file_handle.close
    print result
    result = result.replace('\n', '')
    result = result.replace(' ', '')
    result = result.replace(',', '')
    result = result.replace('\'', '')
    print result

    values = {'cametu':result}
    post_data = urllib.urlencode(values)
    opener.addheaders.append(('Referer', 'http://www.enigmagroup.org/missions/captcha/1/image.php'))
    response = opener.open('http://www.enigmagroup.org/missions/captcha/1/image.php', post_data)
    file_handle = open('result.html', 'w')
    while 1:
        data = response.read()
        if not('Failed' in data) and data:
            continue_loop = False
        if not data:
            break
        file_handle.write(data)
    file_handle.close
    if continue_loop == False:
        break
