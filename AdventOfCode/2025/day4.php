<?php
require_once('../req.php');
$data = loadCookies(4);
$data = trim($data);
$lines = explode("\n", $data);

$grid = array_map('str_split', $lines);
$rows = count($grid);
$cols = count($grid[0]);
$accessible = 0;

$dirs = [
    [-1,-1], [-1,0], [-1,1],
    [ 0,-1],         [ 0,1],
    [ 1,-1], [ 1,0], [ 1,1]
];

for ($r = 0; $r < $rows; $r++) {
    for ($c = 0; $c < $cols; $c++) {

        if ($grid[$r][$c] !== '@') {continue;}
        $count = 0;

        foreach ($dirs as [$dr, $dc]) {
            $nr = $r + $dr;
            $nc = $c + $dc;

            if ($nr >= 0 && $nr < $rows && $nc >= 0 && $nc < $cols) {
                if ($grid[$nr][$nc] === '@') { $count++;}
            }
        }
        if ($count < 4) { $accessible++;}
    }
}
echo "Accessible rolls of paper: $accessible\n";

$totalRemoved = 0;
$round = 0;
while (true) {
    $toRemove = []; 

    for ($r2 = 0; $r2 < $rows; $r2++) {
        for ($c2 = 0; $c2 < $cols; $c2++) {
            if ($grid[$r2][$c2] !== '@') continue;

            $adjCount = 0;
            foreach ($dirs as $d) {
                $nr2 = $r2 + $d[0];
                $nc2 = $c2 + $d[1];
                if ($nr2 >= 0 && $nr2 < $rows && $nc2 >= 0 && $nc2 < $cols) {
                    if ($grid[$nr2][$nc2] === '@') $adjCount++;
                }
            }
            if ($adjCount < 4) {
                $toRemove[] = [$r2, $c2];
            }
        }
    }

	$num = count($toRemove);
    if ($num === 0) break; // nothing more accessible -> stop

    foreach ($toRemove as [$rr, $cc]) {
        $grid[$rr][$cc] = '.';
    }

    $totalRemoved += $num;
    $round++;
}

echo "<br />Total rolls of paper removed: $totalRemoved\n";
?>
