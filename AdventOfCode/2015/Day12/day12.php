<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/12/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);
unset($map[1]);

$total=0;

preg_match_all('/-?[0-9]+/', $map[0], $m);
foreach($m[0] as $i){ $total += (int)$i; }

echo 'There are a total of: '. $total.' numbers.<br />';

function jsonTotal($basket=array(),$num){
    $jtotal=0;
    foreach($num as $line){
        if(is_array($line)){
            $jtotal += jsonTotal($basket,$line);
        }elseif(is_object($line)){
            $error=false;
            foreach($line as $n){
                if(is_string($n) && in_array((string)$n,$basket)){
                    $error=true;    break;
                }
            }
            if(!$error){ $jtotal += jsonTotal($basket,$line);}
        }elseif(is_numeric($line)){    $jtotal += $num; }
    }
    return $jtotal;
}

$json = json_decode($map[0]);
echo 'There are a total of '.jsonTotal(array("red"),$json).' reds.<br />';

?>
