<?
#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'xxxxxxxxxx';
$referer = 'http://www.enigmagroup.org/missions/programming/8/image.php'; 
$cookie = 'PHPSESSID=xxxxxxxx;enigmafiedV4=xxxxxxxxxxxxxx';

#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_REFERER, $referer);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/8/image.php');
$result = curl_exec($ch);

##########################################################################################################################

// grab the color image and download it//
	
	$img 	= imagecreatefromstring($result);
	$imgW 	= imagesx($img);
	$imgH 	= imagesy($img);
	
for ($y=0; $y < $imgH; $y++){
	for ($x=0; $x < $imgW; $x++){		
		$res = imagecolorat($img,$x,$y);
		$rgb = imagecolorsforindex($img, $res);
	
		$r = ord($rgb['red']);
		$g = ord($rgb['green']);
		$b = ord($rgb['blue']);
		
		$line .= '#'.$r.$g.$b.' ';
	}
	
	echo 'line['.$y.']:<font size="1px">'. $line.'</font><br />';
	$line = '';
}
	?>
	<html>
	<title>Programming 8 by Synstealth</title>
    <body>
    <center><h2><b>Programming 8 - captcha decoder</b></h2></center><br />
    <table border="1" cellpadding="5"cellspacing="5" width="400" align="center">
    <tr><td align="center">
        <table border="0" cellpadding="5" cellspacing="5" width="100%" align="center">
        <tr>
            <td><b>Image RGB color:</b></td>
            <td align="center"></td>
        </tr>
    </table>

<?
//$postfields = "color=$r;$g;$b&submit=1"; 	
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
//echo curl_exec($ch); 
curl_close($ch);
?>
	
