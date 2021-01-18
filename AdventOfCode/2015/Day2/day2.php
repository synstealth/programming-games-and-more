<?

require_once('../../core/init.php');
$output = aocGetinputFile("https://adventofcode.com/2015/day/2/input");
$map = expode(PHP_EOL,$output);

$total=0;
$rib_total=0;

foreach($map as $line){
  list($l,$w,$h) = explode("x",$line);
  $paper = (2*$l*$w) + (2*$w*$h) + (2*$h*$l);
  $dimen = array($l,$w,$h);
  sort($dimen);
  $rib_slack = ($dimen[0]*$dimen[1]);
  $total += ($paper+$rib_slack);
  $ribbon = ($dimen[0]*2)+($dimen[1]*2)+($l*$w*$h);
  $rib_total += $ribbon;
}
  
echo 'The Total is: '.$total.' and your Ribbon total is: '.$rib_total.'<br />';
  
?>
