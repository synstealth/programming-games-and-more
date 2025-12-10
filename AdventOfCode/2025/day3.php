<?php
require_once('../req.php');
$data = loadCookies(3);

$data = trim($data);
$lines = explode("\n", $data);
$total1 = 0;
$total2 = 0;
$K = 12;

foreach ($lines as $line) {
    $line = trim($line);
    $len = strlen($line);
    $maxJolt = 0;
	
	$digits = str_split($line);
	$N = count($digits);
	$result = "";
	$start = 0;
	
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = $i + 1; $j < $len; $j++) {
            $value = intval($line[$i] . $line[$j]);
            if ($value > $maxJolt) {
                $maxJolt = $value;
            }
        }
    }
    $total1 += $maxJolt;
	
	for ($pick = 0; $pick < $K; $pick++) {

        $remaining = $K - $pick;
        $end = $N - $remaining;
        $maxDigit = -1;
        $maxIndex = $start;

        for ($i = $start; $i <= $end; $i++) {
            if ($digits[$i] > $maxDigit) {
                $maxDigit = $digits[$i];
                $maxIndex = $i;
            }
        }
        $result .= $maxDigit;
        $start = $maxIndex + 1;
    }
	$total2 += intval($result);
}

echo "Total output joltage for part1: $total1\n";
echo "Total output joltage for part2: $total2\n";

?>
