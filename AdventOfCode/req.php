<?php
function loadCookies($day){
	$session = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
	$url = "https://adventofcode.com/2025/day/".$day."/input";
	$options = [
		"http" => [
			"method" => "GET",
			"header" => "Cookie: session={$session}\r\n" . "User-Agent: synstealth@gmail.com\r\n"
		]
	];
	
	$context = stream_context_create($options);
	$input = file_get_contents($url, false, $context);
	if ($input === false){die("Failed to fetch Advent of Code input.");}
	
	return $input;
}
?>
