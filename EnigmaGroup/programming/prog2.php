<?
#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'SevenMGTEbug007';
#############################################################

// is curl installed?
if (!function_exists('curl_init')){ die('CURL is not installed!');}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0); 

// post the login data (string)
curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.urlencode($login_email).'&passwrd='.urlencode($login_pass).'&cookieneverexp=on&hash_password=a7f9e74c5f2dcdd07998c42007fac4a3');
curl_setopt($ch, CURLOPT_POST, 1);

// should curl return or print the data? 1 = return, 0 = print
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$page = curl_exec($ch);  // done logged in //

##########################################################################################################################

curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/2/');
$output = curl_exec($ch);	// render the challenge page (output) //
//echo($output.'<br /><br /><hr><br /><br />');

// capture the string and filter out the random string //
preg_match_all("/.*number(.*)+/",$output,$randomStr);
preg_match_all("/number .*[0-9]/",$randomStr[0][0],$clean);
// split contents into a list to grab the numbers by itself //
$strList = explode(' ',$clean[0][0]);
$randomNumber = $strList[1];
// multiply by 4
$answer = $randomNumber * 4;

// capture the hidden form data and the random hash //
preg_match_all('/<input type=".*?" name="(.*?)" value="(.*?)" \/>/', $output, $matches);
// E[number]
$Enumber = $matches[2][1];
// E[time]
$Etime = $matches[2][2];
// hash
$hash = $matches[2][3];

//echo '<b>Grabbed Random Number: '.$randomNumber.', Multiplied by 4: '.$answer.'</b>';

//curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/2/index.php');
curl_setopt($ch, CURLOPT_POSTFIELDS,'answer='.$answer.'&E%5Bnumber%5D='.$Enumber.'&E%5Btime%5D='.$Etime.'&hash='.$hash.'&submit=Submit+Answer');


// render the post data //
echo curl_exec($ch);
curl_close($ch);
?>