<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/1/input";
$output = aocGetinputFile($url);
$map = str_split($output);

$floor=0;$base=false;$level=0;
foreach($map as $chr){
	if(!$base){$level++;}
	switch($chr){
		case '(': $floor++;	break;
		case ')': $floor--; break;
	}
	if($floor <= -1){$base=true;}
}
echo 'You are now at Floor: '.$floor.' and the first basement is: '.$level.'<br />';
?>
