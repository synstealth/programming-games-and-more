<?php
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/7/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);


function getState($gates,$g){

    switch($action){
        case 'AND':        $final = ($input & $value);        break;
        case 'OR':        $final = ($input | $value);        break;
        case 'XOR':        $final = ($input ^ $value);        break;
        case 'NOT':        $final = (~ $value & 0xFFFF);    break;
        case 'LSHIFT':    $final = ($input << $value);    break;
        case 'RSHIFT':    $final = ($input >> $value);    break;
        case 'NULL':
        case 'null':    $final = $value; 
    }
    $gates[$g]['final'] = $final;

    return $gates[$g]['final'];
}


$gatesArr=array();
foreach($map as $line){
    if(preg_match('#(?:(?:(.*) )?(.*)? )?(.*) -> (.*)#SAD', $line, $matches)){
        $gatesArr[$matches[4]]['all']     = $matches[0];
        $gatesArr[$matches[4]]['input']     = $matches[1];
        $gatesArr[$matches[4]]['action'] = $matches[2];
        $gatesArr[$matches[4]]['value']     = $matches[3];
        
    }
    
}

echo '<pre>';
print_r($gatesArr);
echo '</pre>';

?>
