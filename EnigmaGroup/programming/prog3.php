<?
#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'xxxxxxxxxx';
$referer = 'http://www.enigmagroup.org/missions/programming/3/image.php'; 
$cookie = 'PHPSESSID=xxxxxxxxx;enigmafiedV4=xxxxxxxxxxxx';
#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_REFERER, $referer);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/3/image.php');
$result = curl_exec($ch);

##########################################################################################################################

// grab the color image and download it//
	
	$img = imagecreatefromstring($result); 
	$rgb = imagecolorat($img, 1, 1); 
	$rgb = imagecolorsforindex($img, $rgb);
	
	$r = $rgb['red'];
	$g = $rgb['green'];
	$b = $rgb['blue'];
	
	?>
	<html>
	<title>Programming 3 by Synstealth</title>
    <body>
    <center><h2><b>Programming 3 - image color decoder</b></h2></center><br />
    <table border="1" cellpadding="5"cellspacing="5" width="400" align="center">
    <tr><td align="center">
        <table border="0" cellpadding="5" cellspacing="5" width="100%" align="center">
        <tr>
            <td><b>Image RGB color:</b></td>
            <td align="center"><?=$r; ?>;<?=$g; ?>;<?=$b; ?></td>
        </tr>
    </table>

<?
$postfields = "color=$r;$g;$b&submit=1"; 	
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
echo curl_exec($ch); 
curl_close($ch);
?>
	
