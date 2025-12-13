<?php
require_once('../req.php');
$data = loadCookies(5);
$data = trim($data);

// Split input into ranges and ingredient IDs
list($rangeBlock, $idBlock) = explode("\n\n", $data);

$ranges = [];
foreach (explode("\n", $rangeBlock) as $line) {
    list($start, $end) = explode("-", trim($line));
    $ranges[] = [(int)$start, (int)$end];
}

// Parse ingredient IDs
$ingredientIds = array_map('intval', explode("\n", trim($idBlock)));
$freshCount = 0;

foreach ($ingredientIds as $id) {
    foreach ($ranges as [$start, $end]) {
        if ($id >= $start && $id <= $end) {
            $freshCount++;
            break;
        }
    }
}

echo $freshCount;
?>
