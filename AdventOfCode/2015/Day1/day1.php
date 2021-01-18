<?
$theFile = fopen("day1.txt","r");
$map=array();
while(!feof($theFile)){
	$line = fgets($theFile);
	array_push($map,$line);
}
fclose($theFile);

$floor=0;
foreach($map as $chr){
	$dir = str_split($chr,1);
	foreach($dir as $d){
		switch($d){
			case '(': $floor++;	break;
			case ')': $floor--; break;
		}
	}
}
echo 'You are now at Floor: '.$floor.'<br />';
?>
