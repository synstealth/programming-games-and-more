<?php
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/8/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);

$t=0;$c=0;$e=0;

foreach($map as $l){
    
    $Len = strlen($l);
    preg_match('#"(.*)"#SAD', $l, $p);
    $p = $p[1];
    $p = preg_replace('#\\\(["\\\])#', '\1', $p);
    $p = preg_replace_callback('#\\\x([A-F0-9]{2})#i', 
        function($matches){ return chr(hexdec($matches[1])); }
        ,$p);
    $pLen = strlen($p);
    
    $enc = $l;
    $enc = preg_replace('#["\\\]#', '\\\1', $enc);
    $enc = '"'.$enc.'"';
    $eLen = strlen($enc);

    $t += $Len;
    $c += $pLen;
    $e += $eLen;
}

echo '<br />';
echo 'Total Length: '.$t.'<br />';
echo 'Total Memory: '.$c.'<br />';
echo 'Total Encoded: '.$e.'<br /><br />';
echo 'Memory Difference: '.($t-$c).'<br />';
echo 'Encoded Difference: '.($e-$t).'<Br />';
?>
