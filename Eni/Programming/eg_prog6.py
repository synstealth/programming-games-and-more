import re , urllib , urllib2 , collections


opener = urllib2.build_opener()
opener.addheaders = [('User-Agent', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:23.0) Gecko/20100101 Firefox/23.0')]
opener.addheaders.append(('Cookie', 'enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1626280002%3Bi%3A3%3Bi%3A2%3B%7D; PHPSESSID=0iljne9tnca491qum1100s3sf7; __utma=115660889.858976642.1437144354.1437144354.1437144354.1; __utmc=115660889; __utmz=115660889.1437144354.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'))


f = open('keywords.txt','rb')
lines = [line for line in f]
f.close

def lawej(var,lt):
	for alt in lt:
		k = alt
		k = k.replace("\n",'')
		k = k.replace("\r",'')
		k = ' '.join(k.split())
		if sorted(var) == sorted(k):
			return k
while(True):
	ans = []
	resp = opener.open('http://www.enigmagroup.org/missions/programming/6/')
	html = resp.read()
	p = html.find("style7")
	p2 = html.find("</p>",p)
		
	text = html[p+8:p2]
	z = text.split("\n")
	for a in z:
			k = a
			k = k.replace("<br />","")
			k = k.replace("\r","")
			anag = lawej(k,lines)
			ans.append(anag)

	ch =""
	for aa in ans:
		ch += str(aa)+","
	baba = ch[5:-6]
	baba = baba.replace("\n","")
	baba = baba.replace("\r","")
	values = {'anagram':baba,'submit':'true'}
	post_data = urllib.urlencode(values)
	print post_data
	link = "http://www.enigmagroup.org/missions/programming/6/submit.php"
	resp2 = opener.open(link,post_data)
	html2 = resp2.read()

	f = open('6.html','wb')
	f.write(html2)
	f.close
	print "[+] Submitted !"
