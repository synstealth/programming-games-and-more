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
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$page = curl_exec($ch);  // done logged in //

##########################################################################################################################
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/9/');
$output = curl_exec($ch);

// filter out the data in the <td> lines 
preg_match_all("/<td.*?>(.*?)<\/td>/", $output, $td);
// filter out the numbers 
preg_match_all("/<strong.*?>(.*?)<\/strong>/", $output, $numbers);
// filter out the image name
preg_match_all('/<img(.*?)\ssrc="([^"]*)"/s',$output,$sh);
$count=0;
$result=array();
foreach($td[1] as $line){
	if(preg_match('/<img(.*?)\ssrc="([^"]*)"/s',$line)){
		$fix = substr($line,17);
		$shape = substr($fix,0,strlen($fix)-6);
		//echo $shape.'<br />';
		array_push($result,$shape);
	}else{
		if(preg_match("/<strong.*?>(.*?)<\/strong>/", $line)){
			$nfix = substr(htmlspecialchars($line),14);
			$number = substr(htmlspecialchars($nfix),0,strlen($nfix)-15);
			//echo $number.'<br />';
			array_push($result,$number);
		}else{
			//echo 'NULL<br />';
			if($count <= 34){
				array_push($result,'-');
			}
		}
	}
	$count++;
}

echo '<table border="1" width="400" align="center">';
echo '<tr><td width="15%" align="center">'.$result[0].'</td><td width="15%" align="center">'.$result[1].'</td><td width="15%" align="center">'.$result[2].'</td><td width="15%" align="center">'.$result[3].'</td><td width="15%" align="center">'.$result[4].'</td><td width="15%" align="center">'.$result[5].'</td></tr>';
echo '<tr><td align="center">'.$result[6].'</td><td  align="center">'.$result[7].'</td><td  align="center">'.$result[8].'</td><td  align="center">'.$result[9].'</td><td  align="center">'.$result[10].'</td><td  align="center">'.$result[11].'</td></tr>';
echo '<tr><td  align="center">'.$result[12].'</td><td  align="center">'.$result[13].'</td><td  align="center">'.$result[14].'</td><td  align="center">'.$result[15].'</td><td  align="center">'.$result[16].'</td><td  align="center">'.$result[17].'</td></tr>';
echo '<tr><td  align="center">'.$result[18].'</td><td  align="center">'.$result[19].'</td><td  align="center">'.$result[20].'</td><td  align="center">'.$result[21].'</td><td  align="center">'.$result[22].'</td><td  align="center">'.$result[23].'</td></tr>';
echo '<tr><td  align="center">'.$result[24].'</td><td  align="center">'.$result[25].'</td><td  align="center">'.$result[26].'</td><td  align="center">'.$result[27].'</td><td  align="center">'.$result[28].'</td><td  align="center">'.$result[29].'</td></tr>';
echo '<tr><td  align="center">'.$result[30].'</td><td  align="center">'.$result[31].'</td><td  align="center">'.$result[32].'</td><td  align="center">'.$result[33].'</td><td  align="center">'.$result[34].'</td><td  align="center">&nbsp;</td></tr>';
echo '</table>';
echo '<hr>';

for($x=0; $x<count($result); $x++){
	
	switch($result[$x]){
		case 'circle':		
			switch($x){
				case '0':	$circle_total += ($result[30]+$result[5]);	break;	
				case '1':	$circle_total += ($result[31]+$result[5]);	break;
				case '2':	$circle_total += ($result[32]+$result[5]);	break;
				case '3':	$circle_total += ($result[33]+$result[5]);	break;
				case '4':	$circle_total += ($result[34]+$result[5]);	break;
				case '5':	break;
				case '6':	$circle_total += ($result[30]+$result[11]);	break;
				case '7':	$circle_total += ($result[31]+$result[11]);	break;
				case '8':	$circle_total += ($result[32]+$result[11]);	break;
				case '9':	$circle_total += ($result[33]+$result[11]);	break;
				case '10':	$circle_total += ($result[34]+$result[11]);	break;
				case '11':	break;	
				case '12':	$circle_total += ($result[30]+$result[17]);	break;
				case '13':	$circle_total += ($result[31]+$result[17]);	break;
				case '14':	$circle_total += ($result[32]+$result[17]);	break;
				case '15':	$circle_total += ($result[33]+$result[17]);	break;
				case '16':	$circle_total += ($result[34]+$result[17]);	break;
				case '17':	break;
				case '18':	$circle_total += ($result[30]+$result[23]);	break;
				case '19':	$circle_total += ($result[31]+$result[23]);	break;
				case '20':	$circle_total += ($result[32]+$result[23]);	break;
				case '21':	$circle_total += ($result[33]+$result[23]);	break;
				case '22':	$circle_total += ($result[34]+$result[23]);	break;
				case '23':	break;
				case '24':	$circle_total += ($result[30]+$result[29]);	break;
				case '25':	$circle_total += ($result[31]+$result[29]);	break;
				case '26':	$circle_total += ($result[32]+$result[29]);	break;
				case '27':	$circle_total += ($result[33]+$result[29]);	break;
				case '28':	$circle_total += ($result[34]+$result[29]);	break;
				case '29':	break;
			}
			break;
				
		case 'star':
			switch($x){
				case '0':	$star_total += ($result[30]+$result[5]);	break;	
				case '1':	$star_total += ($result[31]+$result[5]);	break;
				case '2':	$star_total += ($result[32]+$result[5]);	break;
				case '3':	$star_total += ($result[33]+$result[5]);	break;
				case '4':	$star_total += ($result[34]+$result[5]);	break;
				case '5':	break;
				case '6':	$star_total += ($result[30]+$result[11]);	break;
				case '7':	$star_total += ($result[31]+$result[11]);	break;
				case '8':	$star_total += ($result[32]+$result[11]);	break;
				case '9':	$star_total += ($result[33]+$result[11]);	break;
				case '10':	$star_total += ($result[34]+$result[11]);	break;
				case '11':	break;	
				case '12':	$star_total += ($result[30]+$result[17]);	break;
				case '13':	$star_total += ($result[31]+$result[17]);	break;
				case '14':	$star_total += ($result[32]+$result[17]);	break;
				case '15':	$star_total += ($result[33]+$result[17]);	break;
				case '16':	$star_total += ($result[34]+$result[17]);	break;
				case '17':	break;
				case '18':	$star_total += ($result[30]+$result[23]);	break;
				case '19':	$star_total += ($result[31]+$result[23]);	break;
				case '20':	$star_total += ($result[32]+$result[23]);	break;
				case '21':	$star_total += ($result[33]+$result[23]);	break;
				case '22':	$star_total += ($result[34]+$result[23]);	break;
				case '23':	break;
				case '24':	$star_total += ($result[30]+$result[29]);	break;
				case '25':	$star_total += ($result[31]+$result[29]);	break;
				case '26':	$star_total += ($result[32]+$result[29]);	break;
				case '27':	$star_total += ($result[33]+$result[29]);	break;
				case '28':	$star_total += ($result[34]+$result[29]);	break;
				case '29':	break;
			}
			break;
		case 'square':
			switch($x){
				case '0':	$square_total += ($result[30]+$result[5]);	break;	
				case '1':	$square_total += ($result[31]+$result[5]);	break;
				case '2':	$square_total += ($result[32]+$result[5]);	break;
				case '3':	$square_total += ($result[33]+$result[5]);	break;
				case '4':	$square_total += ($result[34]+$result[5]);	break;
				case '5':	break;
				case '6':	$square_total += ($result[30]+$result[11]);	break;
				case '7':	$square_total += ($result[31]+$result[11]);	break;
				case '8':	$square_total += ($result[32]+$result[11]);	break;
				case '9':	$square_total += ($result[33]+$result[11]);	break;
				case '10':	$square_total += ($result[34]+$result[11]);	break;
				case '11':	break;	
				case '12':	$square_total += ($result[30]+$result[17]);	break;
				case '13':	$square_total += ($result[31]+$result[17]);	break;
				case '14':	$square_total += ($result[32]+$result[17]);	break;
				case '15':	$square_total += ($result[33]+$result[17]);	break;
				case '16':	$square_total += ($result[34]+$result[17]);	break;
				case '17':	break;
				case '18':	$square_total += ($result[30]+$result[23]);	break;
				case '19':	$square_total += ($result[31]+$result[23]);	break;
				case '20':	$square_total += ($result[32]+$result[23]);	break;
				case '21':	$square_total += ($result[33]+$result[23]);	break;
				case '22':	$square_total += ($result[34]+$result[23]);	break;
				case '23':	break;
				case '24':	$square_total += ($result[30]+$result[29]);	break;
				case '25':	$square_total += ($result[31]+$result[29]);	break;
				case '26':	$square_total += ($result[32]+$result[29]);	break;
				case '27':	$square_total += ($result[33]+$result[29]);	break;
				case '28':	$square_total += ($result[34]+$result[29]);	break;
				case '29':	break;
			}
			break;
		case 'triangle':
			switch($x){
				case '0':	$triangle_total += ($result[30]+$result[5]);	break;	
				case '1':	$triangle_total += ($result[31]+$result[5]);	break;
				case '2':	$triangle_total += ($result[32]+$result[5]);	break;
				case '3':	$triangle_total += ($result[33]+$result[5]);	break;
				case '4':	$triangle_total += ($result[34]+$result[5]);	break;
				case '5':	break;
				case '6':	$triangle_total += ($result[30]+$result[11]);	break;
				case '7':	$triangle_total += ($result[31]+$result[11]);	break;
				case '8':	$triangle_total += ($result[32]+$result[11]);	break;
				case '9':	$triangle_total += ($result[33]+$result[11]);	break;
				case '10':	$triangle_total += ($result[34]+$result[11]);	break;
				case '11':	break;	
				case '12':	$triangle_total += ($result[30]+$result[17]);	break;
				case '13':	$triangle_total += ($result[31]+$result[17]);	break;
				case '14':	$triangle_total += ($result[32]+$result[17]);	break;
				case '15':	$triangle_total += ($result[33]+$result[17]);	break;
				case '16':	$triangle_total += ($result[34]+$result[17]);	break;
				case '17':	break;
				case '18':	$triangle_total += ($result[30]+$result[23]);	break;
				case '19':	$triangle_total += ($result[31]+$result[23]);	break;
				case '20':	$triangle_total += ($result[32]+$result[23]);	break;
				case '21':	$triangle_total += ($result[33]+$result[23]);	break;
				case '22':	$triangle_total += ($result[34]+$result[23]);	break;
				case '23':	break;
				case '24':	$triangle_total += ($result[30]+$result[29]);	break;
				case '25':	$triangle_total += ($result[31]+$result[29]);	break;
				case '26':	$triangle_total += ($result[32]+$result[29]);	break;
				case '27':	$triangle_total += ($result[33]+$result[29]);	break;
				case '28':	$triangle_total += ($result[34]+$result[29]);	break;
				case '29':	break;
			}
			break;
		case 'heart':
			switch($x){
				case '0':	$heart_total += ($result[30]+$result[5]);	break;	
				case '1':	$heart_total += ($result[31]+$result[5]);	break;
				case '2':	$heart_total += ($result[32]+$result[5]);	break;
				case '3':	$heart_total += ($result[33]+$result[5]);	break;
				case '4':	$heart_total += ($result[34]+$result[5]);	break;
				case '5':	break;
				case '6':	$heart_total += ($result[30]+$result[11]);	break;
				case '7':	$heart_total += ($result[31]+$result[11]);	break;
				case '8':	$heart_total += ($result[32]+$result[11]);	break;
				case '9':	$heart_total += ($result[33]+$result[11]);	break;
				case '10':	$heart_total += ($result[34]+$result[11]);	break;
				case '11':	break;	
				case '12':	$heart_total += ($result[30]+$result[17]);	break;
				case '13':	$heart_total += ($result[31]+$result[17]);	break;
				case '14':	$heart_total += ($result[32]+$result[17]);	break;
				case '15':	$heart_total += ($result[33]+$result[17]);	break;
				case '16':	$heart_total += ($result[34]+$result[17]);	break;
				case '17':	break;
				case '18':	$heart_total += ($result[30]+$result[23]);	break;
				case '19':	$heart_total += ($result[31]+$result[23]);	break;
				case '20':	$heart_total += ($result[32]+$result[23]);	break;
				case '21':	$heart_total += ($result[33]+$result[23]);	break;
				case '22':	$heart_total += ($result[34]+$result[23]);	break;
				case '23':	break;
				case '24':	$heart_total += ($result[30]+$result[29]);	break;
				case '25':	$heart_total += ($result[31]+$result[29]);	break;
				case '26':	$heart_total += ($result[32]+$result[29]);	break;
				case '27':	$heart_total += ($result[33]+$result[29]);	break;
				case '28':	$heart_total += ($result[34]+$result[29]);	break;
				case '29':	break;
			}
			break;
	}
}

echo '<table border="0" width="400" align="center">';
echo '<tr><td>Circle Totals: </td><td>'.$circle_total.'</td></tr>';
echo '<tr><td>Square Totals:  </td><td>'.$square_total.'</td></tr>';
echo '<tr><td>Triangle Totals:  </td><td>'.$triangle_total.'</td></tr>';
echo '<tr><td>Star Totals:  </td><td>'.$star_total.'</td></tr>';
echo '<tr><td>Heart Totals:  </td><td>'.$heart_total.'</td></tr>';
echo '</table>';

//circle=2&heart=3&square=4&triangle=5&star=6&submit=Submit
$query = 'index.php?circle='.$circle_total.'&heart='.$heart_total.'&square='.$square_total.'&triangle='.$triangle_total.'&star='.$star_total.'&submit=Submit';

echo '<hr>';
echo 'Your query: [ '.$query.' ]';
echo '<hr>';

//curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/9/index.php?'.urlencode($query));
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
echo curl_exec($ch); 
curl_close($ch);
?>
