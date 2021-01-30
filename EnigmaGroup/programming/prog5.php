<?
function brainfuck_debug(&$s, &$_s, &$d, &$_d, &$i, &$_i, &$o) {
  echo "<table>\n";
  echo "<tr><td><b>Position</b></td><td><b>Value</b></td><td><b>ASCII</b></td></tr>\n";
  foreach($d as $element => $value) {
    echo "<tr>\n";
    echo "<td align=\"center\">" . $element . "</td>\n";
        echo "<td align=\"center\">" . ord($value) . "</td>\n";
        echo "<td align=\"center\">" . (ord($value) >= 32 ? htmlentities($value) : "&nbsp;") . "</td>\n";
        echo "</tr>\n";
  } 
  echo "</table>\n";
}

function brainfuck_interpret(&$s, &$_s, &$d, &$_d, &$i, &$_i, &$o) {
   do {
     switch($s[$_s]) {
         /* Execute brainfuck commands. Values are not stored as numbers, but as their
         representing characters in the ASCII table. This is perfect, as chr(256) is
                 automagically converted to chr(0). */
       case '+': $d[$_d] = chr(ord($d[$_d]) + 1); break;
       case '-': $d[$_d] = chr(ord($d[$_d]) - 1); break;
       case '>': $_d++; if(!isset($d[$_d])) $d[$_d] = chr(0); break;
       case '<': $_d--; break;
        
       /* Output is stored in a variable. Change this to
         echo $d[$_d]; flush();
                 if you would like to have a "live" output (when running long calculations, for example.
                 Or if you are just terribly impatient). */
         case '.': $o .= $d[$_d]; break;
        
         /* Due to PHP's non-interactive nature I have the whole input passed over in a string.
         I successively read characters from this string and pass it over to BF every time a
                 ',' command is executed. */
         case ',': $d[$_d] = $_i==strlen($i) ? chr(0) : $i[$_i++]; break;
        
         /* Catch loops */
         case '[':
         /* Skip loop (also nested ones) */
         if((int)ord($d[$_d]) == 0) {
           $brackets = 1;
                 while($brackets && $_s++ < strlen($s)) {
			 if($s[$_s] == '[')
			 $brackets++;
				 else if($s[$_s] == ']')
				 $brackets--;
			 }
                 }else {
           		$pos = $_s++-1;
                 /* The closing ] returns true when the loop has to be executed again. If so, then return to the $pos(ition) where the opening [ is. */
         	if(brainfuck_interpret($s, $_s, $d, $_d, $i, $_i, $o))
         		$_s = $pos;
         }
         break;
         /* Return true when loop has to be executed again. It is redundant to the [ checking, but
         it will save some parsing time (otherwise the interpreter would have to return to [ only to skip all characters again) */
         case ']': return ((int)ord($d[$_d]) != 0);
         /* Call debug function */
         case '#': brainfuck_debug($s, $_s, $d, $_d, $i, $_i, $o);
    }
  } while(++$_s < strlen($s));
}

function brainfuck($source, $input='') {  
  $data = array();
  $data[0] = chr(0);
  $data_index = 0;
  $source_index = 0;
  $input_index = 0; 
  $output = '';
  /* Call the actual interpreter */
  brainfuck_interpret($source, $source_index,$data, $data_index,$input, $input_index,$output);
  return $output;
}



#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'xxxxxxx';
#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.urlencode($login_email).'&passwrd='.urlencode($login_pass).'&cookieneverexp=on&hash_password=xxxxxxxx');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$page = curl_exec($ch);  // done logged in //

##########################################################################################################################

	curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/5/');
	$output = curl_exec($ch);
	
	preg_match_all("/<br .*(.*?)\>/", $output, $matches);
	//echo '<pre>';
	//print_r($matches);
	//echo '</pre>';
	$source=$matches[0][4];
	$answer=brainfuck($source, $input='');
	?>
	<html>
	<title>Programming 5 by Synstealth</title>
    <body>
    <center><h2><b>Programming 5 - BrainFuck Decoder</b></h2></center><br />
    <table border="1" cellpadding="5"cellspacing="5" width="600" align="center">
    <tr><td align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center">
        <tr><td><b>BrainFuck String:</b></td></tr>
       	<tr><td align="left"><?=$source ?></td></tr>
        <tr><td><b>Decrypted BrainFuck String:</b></td></tr>
       	<tr><td align="left"><?=$answer ?></td></tr>
    	</table>
	</td></tr>
    </table>
	<?
	curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/5/index.php?ans='.$answer);
	echo curl_exec($ch); 
	curl_close($ch);
	?>
	
