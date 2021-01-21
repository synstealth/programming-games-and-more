<?
// normally I have curl to fetch the input but this one is a fixed string
$input = 'ckczppom';

function findTheHash($in,$len){
    switch($len){
        case '5':    $match='00000';        break;
        case '6':    $match='000000';    break;
        default:     $match='00000';        break;
    }
    $x=0;$hash='';
    while(true){
        $hash = md5($in.$x);
        if(stripos($hash, $match) === 0){ 
            return 'Number: '.$x.' ==> '.$hash.' for '.$in.'<br />';
            break; 
        }
        $x++;
    }
}

echo 'Match 5 zeros: '.findTheHash($input,5).'<br />';
echo 'Match 6 zeros: '.findTheHash($input,6);

?>
