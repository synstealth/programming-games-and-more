<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/5/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);

function isNiceWord($w){
    $vowels = array('a','e','i','o','u');    
    $unwanted = array('ab','cd','pq','xy');
    
    $duplicates = 0; 
    $vCount = 0;
    $uCount = 0;
    
    // loop thru 
    for($x=0; $x<strlen($w); $x++){
        if(in_array($w[$x],$vowels)){ $vCount++; }
        if($x >= 1 && $w[$x-1] == $w[$x]){ $duplicates++; }
        if($x >= 1 && in_array($w[$x-1].$w[$x],$unwanted)){ $uCount++; }
    }
    if($vCount >= 3 && $duplicates >=1 && $uCount == 0){
        return $vCount;
    }
}
function isNiceWord2($w){
    return preg_match('/(..).*\1/', $w, $out) && preg_match('/(.).\1/', $w);    
}

$total1 = $total2 =0;
foreach($map as $line){
    $res1 = isNiceWord($line);
    if($res1) { $total1++; }
    $res2 = isNiceWord2($line);
    if($res2) { $total2++; }    
}

echo 'There are '.$total1.' nice words<br />';
echo 'There are '.$total2.' nice words (part 2)<br />';

?>
