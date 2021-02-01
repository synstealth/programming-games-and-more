<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/10/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);

foreach($map as $og){
    $count=50; //40
    echo '<br />';
    echo 'Say: "'.$og.'" '.$count.' times.<br />';
    for($i=0; $i<$count; $i++){
        $og = preg_replace_callback('/((.)\2*)/', 
            function($matches){ return strlen($matches[1]).$matches[2];}
        , $og);
    }
    echo 'Length: '.strlen($og).'<br />';
}

?>
