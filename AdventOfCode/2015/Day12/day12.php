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

?>
