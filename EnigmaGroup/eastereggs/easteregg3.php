<?php
/*Easter Egg #3 script from NURV 6 
This script grabs a random png image and posts its heigh, width. 
At the end it is required to post the md5 string of the hex RGB values. */

//Variables :: URL and Cookie
$url = "http://www.enigmagroup.org/missions/realistics/nurv/6/totalNURVcontrol/images/image.php";
$cookie = "PHPSESSID=882faf46bea0d14b2e78fd21b2f3b3e0;enigmafiedV4=a%3A4%3A%7Bi%3A0%3Bs%3A5%3A%2258073%22%3Bi%3A1%3Bs%3A40%3A%22689dab65afe88cc1981aa752751452a9825f78ce%22%3Bi%3A2%3Bi%3A1572666609%3Bi%3A3%3Bi%3A2%3B%7D;";

//Starts cURL session with options
$ch = curl_init();											
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);									//Executes the cURL handler.
$png = fopen("image.png","w");								//Grab random image and create instance of it.
fwrite($png, $response);									//Writes response contents (creates the image).
fclose($png);												//Close file.
echo "<img src=\'image.png\'/><br>";							//Outputs random image.

list($width,$height) = getimagesize("image.png");			//Gets height and width of image.
$im = imagecreatefrompng("image.png");						//Creates temporary image to work on.
$hex = imagecolorat($im,11,1);								//Grabs pixel color.
$rgb = imagecolorsforindex($im,$hex);						//Prepares array of RGB colors.

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

$md5Hex = md5($HexVal);										//Converts hex string to md5 string
echo "md5(HexValues) -> ".$md5Hex."<br>";
$fsubmit = "height=".$height."&width=".$width."&colour=".$md5Hex;

$finalurl = "http://www.enigmagroup.org/missions/realistics/nurv/6/totalNURVcontrol/s3cret5.php";
curl_setopt($ch, CURLOPT_URL, $finalurl);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fsubmit);				//Submit POST
$final = curl_exec($ch);									//Execute cURL
curl_close($ch);											//Close cURL handler
echo $final;	