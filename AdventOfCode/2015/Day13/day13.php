<?
require_once('../../core/init.php');
$url = "https://adventofcode.com/2015/day/13/input";
$output = aocGetinputFile($url);
$map = explode(PHP_EOL,$output);
unset($map[56]);

$people = array();
foreach ($map as $details) {
    preg_match('#(.*) would (gain|lose) ([0-9]+) happiness units by sitting next to (.*).#SAD', $details, $m);
    list($all, $who, $direction, $units, $person) = $m;
    if(!isset($people[$who])){ $people[$who] = array(); }
    $people[$who][$person] = ($direction == 'lose') ? 0 - $units : $units;
}
function permute($items, $perms=array()){
    if(empty($items)){
        $return = array($perms);
    }else{
        $return = array();
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            $return = array_merge($return, permute($newitems, $newperms));
        }
    }
    return $return;
}
function is_happy($people, $order) {
    $total = 0;
    for ($i = 0; $i < count($order); $i++) {
        $last = ($i == 0) ? count($order) - 1 : $i - 1;
        $next = ($i + 1) % count($order);
        $total += $people[$order[$i]][$order[$next]];
        $total += $people[$order[$i]][$order[$last]];
    }

    return $total;
}

function is_best($people) {
    $perms = array_keys($people);
    $start = array_shift($perms);
    $perms = permute($perms);
    $best['order'] = array();
    $best['happiness'] = 0;
    foreach ($perms as $p) {
        array_unshift($p, $start);
        $happiness = is_happy($people, $p);
        if($happiness > $best['happiness']){
            $best['happiness'] = $happiness;
            $best['order'] = $p;
        }
    }
    return $best;
}

$part1 = is_best($people);
echo 'Number of happy peoples: '. $part1['happiness'].'<br />';
echo 'Seating Order: '. implode(', ', $part1['order']).'<br />';

$people['You'] = array();
foreach (array_keys($people) as $p) {
    $people['You'][$p] = 0;
    $people[$p]['You'] = 0;
}

$part2 = is_best($people);
echo 'Number of happy peoples: '. $part2['happiness'].'<br />';
echo 'Seating Order With You In It: '. implode(', ', $part2['order']).'<br />';
