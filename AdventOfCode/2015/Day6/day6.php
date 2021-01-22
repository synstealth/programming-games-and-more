<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/6/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);
unset($map[300]); // remove the last null value

// do instruction!
function processInstructions($arrGrid,$arrInst){
    foreach($arrInst as $i){
        for($x = $i['x1']; $x <= $i['x2']; $x++){
            for($y = $i['y1']; $y <= $i['y2']; $y++){
                switch($i['direction']) {
                    case 'turn on':        
                        //echo 'turning on grid ['.$x.']['.$y.'] = '.$arrGrid[$x][$y];
                        $arrGrid[$x][$y] = 1;
                        //echo ' ==> '.$arrGrid[$x][$y].'<br />';        
                        break;
                    case 'turn off':    
                        //echo 'turning off grid ['.$x.']['.$y.'] = '.$arrGrid[$x][$y];
                        $arrGrid[$x][$y] = 0;        
                        //echo ' ==> '.$arrGrid[$x][$y].'<br />';            
                        break;
                    case 'toggle':
                        //echo 'toggling grid ['.$x.']['.$y.'] = '.$arrGrid[$x][$y];
                        $arrGrid[$x][$y] = ($arrGrid[$x][$y] == 1) ? 0 : 1;        
                        //echo ' ==> '.$arrGrid[$x][$y].'<br />';
                        break;
                    default:    break;
                }
            }
        }
    }
    return $arrGrid;    
}
// build grid
$lights = array();
for($x=0; $x<=999; $x++){for($y=0; $y<=999; $y++){ $lights[$x][$y] = 0; }}    

// arrange instruction from file
$following = array();
foreach($map as $line){
    $matches = ''; $inst = array();
    preg_match('/(.+) ([0-9]+),([0-9]+) through ([0-9]+),([0-9]+)/', $line, $matches);
    $inst['direction'] = $matches[1];
    $inst['x1'] = $matches[2];
    $inst['y1'] = $matches[3];
    $inst['x2'] = $matches[4];
    $inst['y2'] = $matches[5];
    array_push($following,$inst);
}

// process instructions
$lights = processInstructions($lights,$following);

// check for lit lights
$lit=0; $theGrid = count($lights);
for($x=0; $x<=$theGrid; $x++){
    for($y=0; $y<=$theGrid; $y++){
        if($theGrid[$x][$y] == 1){$lit++;}
    }
}    

echo 'There are '.$lit.' lit lights!<br />';

?>
