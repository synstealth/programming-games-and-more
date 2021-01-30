<?
#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";   // this is on a older version - use the current link instead
$login_email = 'synstealth';
$login_pass = 'xxxxxxxxxxx';
#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.$login_email.'&passwrd='.$login_pass.'&cookieneverexp=on&hash_password=xxxxxxxxxxxx');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

##########################################################################################################################

curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/1/');
$output = curl_exec($ch);

curl_setopt($ch, CURLOPT_POSTFIELDS,'ip=192.211.54.181&username=synstealth');
curl_setopt($ch, CURLOPT_COOKIE, 'mission=yes');

echo curl_exec($ch);

curl_close($ch);
?>
