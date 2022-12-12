<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

$head = [
	'x' => 0,
	'y' => 0,
];

$tail = [
	'x' => 0,
	'y' => 0,
];

$head_log = [];
$tail_log = [];

$head_log[ implode( ',', $head ) ] = true;
$tail_log[ implode( ',', $tail ) ] = true;

$head_map = [
	// Up
	'U' => [ 'x' => +0, 'y' => -1 ],
	// Down
	'D' => [ 'x' => +0, 'y' => +1 ],
	// Left
	'L' => [ 'x' => -1, 'y' => +0 ],
	// Right
	'R' => [ 'x' => +1, 'y' => +0 ],
];

$tail_map = [
	// Left
	'+2,-1' => [ 'x' => +1, 'y' => -1 ],
	'+2,+0' => [ 'x' => +1, 'y' => +0 ],
	'+2,+1' => [ 'x' => +1, 'y' => +1 ],
	// Top
	'+1,+2' => [ 'x' => +1, 'y' => +1 ],
	'+0,+2' => [ 'x' => +0, 'y' => +1 ],
	'-1,+2' => [ 'x' => -1, 'y' => +1 ],
	// Right
	'-2,+1' => [ 'x' => -1, 'y' => +1 ],
	'-2,+0' => [ 'x' => -1, 'y' => +0 ],
	'-2,-1' => [ 'x' => -1, 'y' => -1 ],
	// Bottom
	'-1,-2' => [ 'x' => -1, 'y' => -1 ],
	'+0,-2' => [ 'x' => +0, 'y' => -1 ],
	'+1,-2' => [ 'x' => +1, 'y' => -1 ],
];

foreach ( $data as $line ) {
	$n = sscanf( $line, '%s %s', $direction, $steps );

	$head_action = $head_map[ $direction ];

	while ( $steps > 0 ) {
		$head['x'] += $head_action['x'];
		$head['y'] += $head_action['y'];

		$delta_x = $head['x'] - $tail['x'];
		$delta_y = $head['y'] - $tail['y'];

		$key = sprintf( '%+d,%+d', $delta_x, $delta_y );

		if ( array_key_exists( $key, $tail_map ) ) {
			$tail_action = $tail_map[ $key ];

			$tail['x'] += $tail_action['x'];
			$tail['y'] += $tail_action['y'];
		}

		$head_log[ implode( ',', $head ) ] = true;
		$tail_log[ implode( ',', $tail ) ] = true;

		$steps--;
	}
}

echo count( $tail_log );
