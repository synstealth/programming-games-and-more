<?php
require_once('../req.php');
$data = loadCookies(5);
$data = trim($data);

// Split input into ranges and ingredient IDs
list($rangeBlock, $idBlock) = explode("\n\n", $data);

// Only keep the range section
$rangeBlock = explode("\n\n", $data)[0];

$ranges = [];
foreach (explode("\n", $rangeBlock) as $line) {
    list($start, $end) = explode("-", trim($line));
    $ranges[] = [(int)$start, (int)$end];
}


// part2
usort($ranges, function ($a, $b) {
    return $a[0] <=> $b[0];
});

$merged = [];
foreach ($ranges as $range) {
    if (empty($merged)) {
        $merged[] = $range;
        continue;
    }

    $lastIndex = count($merged) - 1;
    [$lastStart, $lastEnd] = $merged[$lastIndex];
    [$start, $end] = $range;

    if ($start <= $lastEnd + 1) {
        $merged[$lastIndex][1] = max($lastEnd, $end);
    } else {
        $merged[] = $range;
    }
}

$totalFresh = 0;
foreach ($merged as [$start, $end]) {
    $totalFresh += ($end - $start + 1);
}

echo $totalFresh;


?>







