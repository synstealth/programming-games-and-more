<?

function isValid($input) {
    if (preg_match('/[iol]/', $input)) { return false; }
    if (!preg_match('/(?:(.)\1).*(?:(.)\2)/', $input, $m)) { return false; }
    for ($i = 0; $i < strlen($input); $i++) {
        if ($i >= 2) {
            if (ord($input[$i - 2]) + 1 == ord($input[$i - 1]) && ord($input[$i - 1]) + 1 == ord($input[$i])) {
                return true;
            }
        }
    }
    return false;
}

function keepGoing($input){
    do{$input++;} 
    while(!keepGoing($input));
    return $input;
}

$i="hepxcrrq";

echo $i.': '.($first = getNext($i)).'<br />';
echo $first.': '.getNext($first).'<br />';

?>
