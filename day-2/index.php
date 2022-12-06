<?php

/**
 * Info.
 * 
 * A X = Rock = 1
 * B Y = Paper = 2
 * C Z = Scissors = 3
 */

$lost = 0;
$draw = 3;
$win  = 6;

$rock     = 1;
$paper    = 2;
$scissors = 3;

$score_map = [
	'A X' => $draw + $rock,
	'A Y' => $win + $paper,
	'A Z' => $lost + $scissors,
	'B X' => $lost + $rock,
	'B Y' => $draw + $paper,
	'B Z' => $win + $scissors,
	'C X' => $win + $rock,
	'C Y' => $lost + $paper,
	'C Z' => $draw + $scissors,
];

$input = file_get_contents( 'input.txt' );

$data = explode( "\n", $input );

$total = 0;

foreach ( $data as $key ) {
	$total += $score_map[ $key ];
}

echo $total;
