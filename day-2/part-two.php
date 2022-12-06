<?php

/**
 * Info.
 * 
 * A = Rock = 1
 * B = Paper = 2
 * C = Scissors = 3
 * 
 * X = lose
 * Y = draw
 * Z = win
 */

$lost = 0;
$draw = 3;
$win  = 6;

$rock     = 1;
$paper    = 2;
$scissors = 3;

$score_map = [
	'A X' => $lost + $scissors, // Scissors lose (X) Rock (A)
	'A Y' => $draw + $rock, // Rock draw (Y) Rock (A)
	'A Z' => $win + $paper, // Paper win (Z) Rock (A)
	'B X' => $lost + $rock, // Rock lose (X) Paper (B)
	'B Y' => $draw + $paper, // Paper draw (Y) Paper (B)
	'B Z' => $win + $scissors, // Scissors win (Z) Paper (B)
	'C X' => $lost + $paper, // Paper lose (X) Scissors (C)
	'C Y' => $draw + $scissors, // Scissors draw (Y) Scissors (C)
	'C Z' => $win + $rock, // Rock win (Z) Scissors (C)
];

$input = file_get_contents( 'input.txt' );

$data = explode( "\n", $input );

$total = 0;

foreach ( $data as $key ) {
	$total += $score_map[ $key ];
}

echo $total;
