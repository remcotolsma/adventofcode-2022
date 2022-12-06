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

foreach ( $data as $line ) {
	$middle = strlen( $line ) / 2;

	$compartment_1 = substr( $line, 0, $middle );
	$compartment_2 = substr( $line, $middle );

	$compartment_1_items = str_split( $compartment_1 );
	$compartment_2_items = str_split( $compartment_2 );

	$compartment_1_types = array_unique( $compartment_1_items );
	$compartment_2_types = array_unique( $compartment_2_items );

	$rearrange_types = array_intersect( $compartment_1_types, $compartment_2_types );

	foreach ( $rearrange_types as $type ) {
		$total += $priority_map[ $type ];
	}
}

echo $total;
