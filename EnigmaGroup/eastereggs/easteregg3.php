<?php
/*Easter Egg #3 script from NURV 6 
This script grabs a random png image and posts its heigh, width. 
At the end it is required to post the md5 string of the hex RGB values. */

//Variables :: URL and Cookie
$url = "http://www.enigmagroup.org/missions/realistics/nurv/6/totalNURVcontrol/images/image.php";
$cookie = "PHPSESSID=xxxxxxxxx";


$ch = curl_init();											
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);			
$png = fopen("image.png","w");				
fwrite($png, $response);						
fclose($png);						
echo "<img src=\'image.png\'/><br>";			

list($width,$height) = getimagesize("image.png");		
$im = imagecreatefrompng("image.png");			
$hex = imagecolorat($im,11,1);		
$rgb = imagecolorsforindex($im,$hex);	

//Output of RGB values
echo "::: Red -> ".$rgb[red]."<br>";
echo "::: Green -> ".$rgb[green]."<br>";
echo "::: Blue -> ".$rgb[blue]."<br><br>"; 

//Output for RGB Hex values
echo ">> Hex of red :: ".dechex($rgb[red])."<br>";
echo ">> Hex of green :: ".dechex($rgb[green])."<br>";
echo ">> Hex of blue :: ".dechex($rgb[blue])."<br>";

$HexVal = "#".dechex($rgb[red]).dechex($rgb[green]).dechex($rgb[blue]);   //Had to add the \'#\' character up front the string. Example: #a299f3

echo "<br>Width = ".$width."<br>";
echo "Height = ".$height."<br>";
echo "Hex = ".$HexVal."<br><br>";

$md5Hex = md5($HexVal);		
echo "md5(HexValues) -> ".$md5Hex."<br>";
$fsubmit = "height=".$height."&width=".$width."&colour=".$md5Hex;

$finalurl = "http://www.enigmagroup.org/missions/realistics/nurv/6/totalNURVcontrol/s3cret5.php";
curl_setopt($ch, CURLOPT_URL, $finalurl);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fsubmit);
$final = curl_exec($ch);				
curl_close($ch);				
echo $final;	
