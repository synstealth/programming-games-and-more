<?

#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'xxxxxxxxx';
#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.urlencode($login_email).'&passwrd='.urlencode($login_pass).'&cookieneverexp=on&hash_password=xxxxxxxxx');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$page = curl_exec($ch);  // done logged in //

##########################################################################################################################

curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/6/');
$output = curl_exec($ch);

preg_match_all("/.*?(.*?)<br /", $output, $matches);

for($i=8; $i<28; $i++){
	$anagrams .= $matches[0][$i].'<br />';
}

// unscramble here //
$file='hypertext markup language (HTML),php hypertext preprocessor (PHP),enigma group,assembly language,nullbyte (%00),sql injection,cross site scripting (XSS),cross site request forgery (CSRF),carriage return line feed (CRLF),rooting,buffer overflow (BoF),code auditing,black hat,white hat,red hat linux,ubuntu,kubuntu,xubuntu,edubuntu,gentoo,debian,slackware,backtrack,openSuSE,fedora core,linuxmint,andriva,trixbox,knoppix,damn vulnerable linux (DVL),damn small linux (DSL),winblowz,internet exploder,firefox,iceweasil,adamantix,pingOO,xandros,freeBSD,openBSD,netBSD,linus torvalds,bill gates,steve jobs,structured query language (SQL),ethereal,wireshark,advanced packaging tool (APT),redhat package management (RPM),proof of concent (PoC),graphics draw library (GD),cookie poisoning,form poisoning,union all select,curl library,secure sockets layer (SSL),secure shell (SSH),file transfer protocol (FTP),domain name service (DNS),dynamic host configuration protocol (DHCP),mail exchange (MX),post office protocol (POP),simple mail transfer protocol (smtp),mail spoofing,captcha,optical character recognition (OCR),programming challenges,practical extraction and reporting language (PERL),visual basic,vbscript,zohh emmm exxx (zomx),compression,kickban,/gline,/kline,hackers,hackers 2 - operation takedown,hackers 3 - antitrust,brute force,quick and dirty (QnD),quick and nasty (QnN),berkeley system distribution (BSD),polymorphism,cookie monster,kernel panic,blue screen of death (BSoD),code crunching,cyberpunk,cypherpuck,message-digest algorithm 5 (MD5),secure hash algorithm 1 (SHA1),vigenere,cryptography,steganograhy,hooking,microshit (M$),msDoNT,denial of service (DoS),distributed denial of service (DDoS),ping of death (PoD),directory traversal,filter bypass,base64,obfuscated,evilsite,spyware,adware,malware,virus,robots.txt,require_once,fopen(),search and destroy,stfuppercut,social engineering (SE),phishing,pharming,easter egg (./youfoundme.php),swap space,sysadmin,telnet,bindshell,egshell,fuckthewhitehatmovement,content management system (CMS),webmin,phpmyadmin,port scanning,war driving,war dialing,fingerprinting,forensics,footprinting,steganography,cryptology,encryption,decryption,cyper,decypher,full path disclosure (FPD),ircbot,backdoor,firewall,bastion host,pfSense,m0n0wall,javascript,object oriented programming (OOP),sun microsystems,cracker,intrusion detection system (IDS),cascading style sheets (CSS),front end,back end,for the win (FTW),for the lose (FTL),omg (Oh My God),lmao (laughing my ass off),rofl (rolling on the floor laughing),blackhat takeover,whitehat wars,internet relay chat (IRC),cpanel,crytogram,macintrash,torrent,internet protocol (IP),subnet mask,default gateway,network address,network address translation (NAT),reservations,exclusions,red herring,operating system (OS),sourceforge,open source,pseudonym,black market,credit card trade,zero day (0day),exploit,vulnerability,full disclosure,python,ruby,beatrix,acunetix,brute force and ignorance (BFI),repository,safemode,basedir restrictions,unix,linux,centOS,wysiwyg,wysiayg,black box,beige box,phreaking,liveCD,grand unified bootloader (GRUB),azureus,gnu object model environment (GNOME),k desktop environment (KDE),google d0rking,h4x0r,haxxor,hacksaw,whitehats-arent-hackers,blackhats-are-hackers,ezines,site missions,articles,wikistyle,tableless design,happy hacking,pc out,local area network (LAN),metropolitan area network (MAN),wide area network (WAN),wireless local area network (WLAN),prism2,packet injection';
$wordlist=array();
$wordlist = explode(',',$file);
?>
<html>
<title>Programming 6 by Synstealth</title>
<body>
<center><h2><b>Programming 6 - Anagram unscraambler using wordlist</b></h2></center><br />
<table border="1" cellpadding="5"cellspacing="5" width="600" align="center">
<tr><td align="center">
<b>Anagram List:</b>
<table border="0" cellpadding="0" cellspacing="0" width="600" align="center">
<?
for($i=8; $i<28; $i++){
	$mlen = strlen($matches[0][$i]);
	$mlen = $mlen-4;
	$scrambledWord = htmlspecialchars(substr($matches[0][$i],0,strlen($matches[0][$i])-4));
	for($x=0; $x<count($wordlist); $x++){
		$string = $wordlist[$x];
		if (count_chars($string) === count_chars($scrambledWord)) {
			echo '<tr><td align="left" width="40%"><b>'.$scrambledWord.'</b></td><td align="center" width="10%">----></td><td align="left" width="40%"><font color="green">'.$string.'</font></td></tr>';
			$answer .= $string.',';
		}
	}
}
?>        
</table>
</td></tr>
</table>
<?
$finalAns = substr($answer,0,strlen($answer)-1);
//"anagram=foo,bar,baz,biz&submit=true
echo '<hr>';
echo '<br />Result to be submitted:[ submit.php?anagram='.$finalAns.'&submit=true ]<br /><br />';
echo '<hr>';

$postfields = 'anagram='.$finalAns.'&submit=true';
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/6/submit.php?'.urlencode($postfields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
echo curl_exec($ch); 
curl_close($ch);
?>
