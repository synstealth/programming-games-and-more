<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/3/input";
$output = aocGetinputFile($url);

function checkHousesWithSanta($out,$people=1){
    $horz = array();
    $vert = array();
    
    $gifts = array(0=>array(0=>0));
    for($x=0; $x<$people; $x++){
        $gifts[0][0]++;
        $horz[$x] = $vert[$x] = 0;
    }
    $houses=1;
    $person=0;
    foreach(str_split($out) as $arrow){
        // move
        switch($arrow){
            case '^':    $vert[$person]++;    break;
            case 'v':    $vert[$person]--;    break;
            case '>':    $horz[$person]++;    break;
            case '<':    $horz[$person]--;    break;
        }
        // create
        if(!isset( $gifts[$horz[$person]][$vert[$person]] )){
            $gifts[$horz[$person]][$vert[$person]]=0;
            $houses++;
        }
        // deliver
        $gifts[$horz[$person]][$vert[$person]]++;
        
        // who delivers?
        $person = ($person+1) % $people;
    }
    return $houses;
}

echo 'Santa found '.checkHousesWithSanta($output,1).' houses with presents<br />';
echo 'Santa and robo found '.checkHousesWithSanta($output,2).' houses with presents<br />';

?>
