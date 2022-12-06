<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

$priority_map = [];

foreach ( range( 'a', 'z' ) as $i => $letter ) {
	$priority_map[ $letter ] = 1 + $i;
}

foreach ( range( 'A', 'Z' ) as $i => $letter ) {
	$priority_map[ $letter ] = 27 + $i;
}

$total = 0;

$groups = array_chunk( $data, 3 );

foreach ( $groups as $group ) {
	$types = array_map(
		function( $rucksack ) {
			return array_unique( str_split( $rucksack ) );
		},
		$group
	);

	$match_types = array_intersect( ...$types );

	foreach ( $match_types as $type ) {
		$total += $priority_map[ $type ];
	}
}

echo $total;
