<?php

$input = file_get_contents( 'input.txt' );

$groups = explode( "\n\n", $input );

$totals = array_map(
	function( $data ) {
		return array_sum( explode( "\n", $data ) );
	},
	$groups
);

sort( $totals, SORT_NUMERIC );

echo array_sum( array_slice( $totals, -3 ) );
