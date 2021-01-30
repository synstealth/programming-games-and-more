<?
#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'SevenMGTEbug007';
$cookie = 'PHPSESSID=a7f9e74c5f2dcdd07998c42007fac4a3;enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1571947672%3Bi%3A3%3Bi%3A2%3B%7D;';

#############################################################
// is curl installed?
if (!function_exists('curl_init')){ die('CURL is not installed!');}

$ch = curl_init();
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org/missions/programming/4/index.php");
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/4/image.php');
$result = curl_exec($ch);

##########################################################################################################################

// grab the color image and download it//
$im = imagecreatefromstring($result); 
$imgWidth = imagesx($im);
$imgHeight = imagesy($im);

for ($y=0; $y < $imgHeight; $y++){
	for ($x=0; $x < $imgWidth; $x++){		
		$res = imagecolorat($im,$x,$y);
		$aryColors = imagecolorsforindex($im,$res);
		// collect binary data here
		$bin .= $res.',';
	}
}
$count=1;
$binList = explode(',',$bin);
foreach($binList as $bits){
	$binresult.=$bits;
	if($count % 4){$binary .= $bits;}else{$binary .= $bits.' ';}
	$count++;
}
function bin2asc($in){
	$out = '';
	for ($i = 0, $len = strlen($in); $i < $len; $i += 8){
		$out .= chr(bindec(substr($in,$i,8)));
	}
	return $out; 
}
$result = bin2asc($binresult);

preg_match_all("/next:.*?(.*)/", $result, $pass);

$password = $pass[1][0];

?>
<html>
<title>Programming 4 by Synstealth</title>
<body>
<center><h2><b>Programming 4 - image unscrambler</b></h2></center><br />
<table border="1" cellpadding="5"cellspacing="5" width="800" align="center">
<tr><td align="center">
	<table border="0" cellpadding="5" cellspacing="5" width="100%" align="center">
	<tr>
		<td><b>Image Binary Data:</b></td>
		<td align="justify"><?=$binary ?></td>
	</tr>
	<tr>
		<td><b>Decoded Message:</b></td>
		<td align="center"><?=$result ?></td>
	</tr>
    <tr>
		<td><b>The Password:</b></td>
		<td align="center"><?=$password ?></td>
	</tr>
</table>

<?
$postfields = 'answer='.$password; 
echo 'Posted answer: ['.$postfields.']<br />';	
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
echo curl_exec($ch); 
curl_close($ch);
?>
	