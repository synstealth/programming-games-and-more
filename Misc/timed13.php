<?
// ----------------------------------- FUNCTIONS ---------------------------------------------- //

	
// XOR function
function xor_func($text,$key){
	for($i=0; $i<strlen($text); $i++){	$text[$i] = intval($text[$i])^intval($key[$i]);	}
	return $text;
}
// ASCII to Binary
function asc2bin($in){
	for ($i=0; $i<strlen($in); $i++){	$out .= sprintf("%08b",ord($in{$i}));	}
	return $out;
}
// bin to hex (4 bits in a group at a time)
function binHex($x){	
	$arr = str_split($x,4);
	foreach($arr as $bin){ 
		switch ($bin){
			case '0000': $out .= '0'; break;
			case '0001': $out .= '1'; break;
			case '0010': $out .= '2'; break;
			case '0011': $out .= '3'; break;
			case '0100': $out .= '4'; break;
			case '0101': $out .= '5'; break;
			case '0110': $out .= '6'; break;
			case '0111': $out .= '7'; break;
			case '1000': $out .= '8'; break;
			case '1001': $out .= '9'; break;
			case '1010': $out .= 'A'; break;
			case '1011': $out .= 'B'; break;
			case '1100': $out .= 'C'; break;
			case '1101': $out .= 'D'; break;
			case '1110': $out .= 'E'; break;
			case '1111': $out .= 'F'; break;
		}
	}
	return $out;
}
// hex to bin ( 1 hex value at a time)
function hexBin($x){
	$arr = str_split($x,1);
	foreach($arr as $b){
		switch ($b){
			case '0': $out .= '0000'; break;
			case '1': $out .= '0001'; break;
			case '2': $out .= '0010'; break;
			case '3': $out .= '0011'; break;
			case '4': $out .= '0100'; break;
			case '5': $out .= '0101'; break;
			case '6': $out .= '0110'; break;
			case '7': $out .= '0111'; break;
			case '8': $out .= '1000'; break;
			case '9': $out .= '1001'; break;
			case 'A': $out .= '1010'; break;
			case 'B': $out .= '1011'; break;
			case 'C': $out .= '1100'; break;
			case 'D': $out .= '1101'; break;
			case 'E': $out .= '1110'; break;
			case 'F': $out .= '1111'; break;
		}
	}
	return $out;
}
// hex to ASCII ( 2 hex value at a time)
	function hexAscii($hex){
		for($i=0; $i<strlen($hex); $i=$i+2) {
			$ascii.=chr(hexdec(substr($hex, $i, 2)));
		}
		return($ascii);
	}
	// ASCII to hex ( 1 ascii value at a time)
	function asciiHex($ascii) {
		for ($i = 0; $i < strlen($ascii); $i++) {
			$byte = dechex(ord($ascii{$i}));
			$byte = str_repeat('0', 2 - strlen($byte)).$byte;
			$hex.=$byte;
		}
		return $hex;
	}

// subsitution function
function sBox($input,$box){
	for($x=0; $x<strlen($input); $x++){
		foreach($box as $s=>$v){
			if((string)substr($input,$x,1) == (string)$s){
				$out .= $v;
			}
		}
	}
	return $out;
}
// permuntation function
function pbox($binIn,$pb,$key){
	$leng = (strlen($binIn)/2);
	$arr = str_split($binIn,$leng);
	$arr1 = str_split($arr[0],1);
	$arr2 = str_split($arr[1],1);
	foreach($pb as $pos => $newpos){		$new1[$newpos] = $arr1[$pos];	}
	foreach($pb as $pos => $newpos){		$new2[$newpos] = $arr2[$pos];	}
	ksort($new1);
	ksort($new2);
	foreach($new1 as $val){$perm1 .= $val;}
	foreach($new2 as $val){$perm2 .= $val;}
	$perm = $perm1.$perm2;
	return $perm;
	
}


// -------------------------------------------------------------------------------------------- //
require_once('functions.php');

if(isset($_POST['check'])){
	
	connect();
	$res = sql("SELECT * FROM users WHERE username='synstealth'");
	
	while($r = mysql_fetch_assoc($res)){
		
		$time_end = microtime(true);
		$time = $time_end - $r['mem_cycle'];
		
		if($time < 3){
			if($r['acct_id'] == $_POST['answer']){
				die('<br /><br /><p align="center">Congrats you earned 100 points! </p>');
			}else{
				die('<br /><br /><p align="center">Wrong answer! please try again!</p>');
				exit();
			}
		}else{
			die('<br /><Br /><Br /><p align="center">Sorry!, You ran out of time!</p>');
			exit();
		}
	}
	
	mysql_close();
	
}else{
	
	$a = str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890');
	$ptext = substr($a,0,4);
	$ptextbin = asc2bin($ptext);
	
	$binarray = array('0000','0001','0010','0011','0100','0101','0110','0111','1000','1001','1010','1011','1100','1101','1110','1111');
	shuffle($binarray);
	foreach($binarray as $bin){	$key .= $bin; }
	$key = substr($key,0,32);
	
	
	$sbox 	= array('0'=>'A','1'=>'0','2'=>'5','3'=>'B','4'=>'2','5'=>'F','6'=>'1','7'=>'8','8'=>'9','9'=>'E','A'=>'6','B'=>'C','C'=>'7','D'=>'3','E'=>'4','F'=>'D');
	shuffle($sbox);
	$sbox['A'] = $sbox[10];
	$sbox['B'] = $sbox[11];
	$sbox['C'] = $sbox[12];
	$sbox['D'] = $sbox[13];
	$sbox['E'] = $sbox[14];
	$sbox['F'] = $sbox[15];
	
	$pbox = array('0'=>'6','1'=>'7','2'=>'0', '3'=>'1','4'=>'2','5'=>'15','6'=>'14','7'=>'11','8'=>'9','9'=>'10', '10'=>'12','11'=>'13','12'=>'3','13'=>'5','14'=>'4','15'=>'8');
	shuffle($pbox);
	
	$key1 = substr($key,0,16);
	$key2 = substr($key,4,16);
	$key3 = substr($key,8,16);
	$key4 = substr($key,12,16);
	$key5 = substr($key,16,16);
	$key1 = $key1.$key1;
	$key2 = $key2.$key2;
	$key3 = $key3.$key3;
	$key4 = $key4.$key4;
	$key5 = $key5.$key5;
	
	// ---------------------------------  round 1  ------------------------------------------- //
	$xor1 	= xor_func($key1,$ptextbin);
	$xor1a 	= binHex($xor1);
	$sb 	= sBox($xor1a,$sbox);
	$sbBin 	= hexBin($sb);
	$perm 	= pbox($sbBin,$pbox,$key);
	
// ---------------------------------  round 2  ------------------------------------------- // 
	$xor2 	= xor_func($key2,$perm);
	$xor2a 	= binHex($xor2);
	$sb2 	= sBox($xor2a,$sbox);
	$sbBin2 = hexBin($sb2);
	$perm2 	= pbox($sbBin2,$pbox,$key);

// ---------------------------------  round 3  ------------------------------------------- //
	$xor3 	= xor_func($key3,$perm2);
	$xor3a 	= binHex($xor3);
	$sb3 	= sBox($xor3a,$sbox);
	$sbBin3 = hexBin($sb3);
	$perm3 	= pbox($sbBin3,$pbox,$key);
	
// ---------------------------------  round 4  ------------------------------------------- //
	$xor4 	= xor_func($key4,$perm3);
	$xor4a 	= binHex($xor4);
	$sb4 	= sBox($xor4a,$sbox);
	$sbBin4 = hexBin($sb4);
	
// ---------------------------------  round 5  ------------------------------------------- //
	$xor5 	= xor_func($key5,$sbBin4);
	$xor5a	= binHex($xor5);
	
// -------------------------------------------------------------------------------------- //
	
	$answer = binHex($xor5);
	$time_start = microtime(true);
	
 	//echo 'answer: '.$xor5.' [<font color="red"> '.hexAscii($answer).'</font> ] [<font color="red"> '.binHex($xor5).'</font> ]</b>';
		
	connect();
	sql("UPDATE users SET acct_id='$answer',mem_cycle='$time_start' WHERE username='synstealth'");
	mysql_close();
	
	
	//  OUTPUT TO HTML //
	?>
    <br />
	<table border="0" cellpadding="5" cellspacing="5" width="650" align="center">
    <tr>
    	<td colspan="2" align="center">
        Encrypt the following plaintext: <b><?=$ptext ?></b> using the SPN encryption. (hint this takes 5 rounds)
        <br />
        Also be sure to post your answer in hex!</td></tr>
    
	<tr>
    	<td width="307" align="center">
        <b>Sbox: </b><br />
        <table border="1" cellpadding="0" cellspacing="0" align="center">
        <tr>
        	<td align="center">0</td><td align="center">1</td><td align="center">2</td><td align="center">3</td>
            <td align="center">4</td><td align="center">5</td><td align="center">6</td><td align="center">7</td>
            <td align="center">8</td><td align="center">9</td><td align="center">A</td><td align="center">B</td>
            <td align="center">C</td><td align="center">D</td><td align="center">E</td><td align="center">F</td>
        </tr>
        <tr>
			<?
			for($i=0; $i<16; $i++){	echo '<td align="center">'.$sbox[$i].'</td>'; }
			?>
        </tr>
        </table>
		</td>
    	<td width="308" align="center">
		<b>Pbox:</b><br />
        <table border="1" cellpadding="0" cellspacing="0" align="center"><tr>
        <?
        for($i=0; $i<16; $i++)	echo '<td align="center">'.$i.'</td>';
        ?>
        </tr><tr>
        <?
        for($p=0; $p<16; $p++)	echo '<td align="center">'.$pbox[$p].'</td>';
		?>
        </tr></table>
		</td>
    </tr>
    
    <tr><td colspan="2">Key: <?=$key ?></td></tr>
    
   
    <tr><td align="center" colspan="2">
    You have <b>3</b> seconds to solve this challenge.<br /><br />
    The answer can be <b>POST</b>ed back to this page, using this form below:
    <form method="post" action="timed13.php">
    <input type="text" name="answer" />
    <input type="submit" name="check" value="Answer!" />
    </form>
    </td></tr>
	</table>
    <br /><br /><br /><p align="center"><b>Coded by Synstealth</b></p>
	<?
}
?>