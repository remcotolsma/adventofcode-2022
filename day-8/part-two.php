<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

$grid = array_map(
	function( $row ) {
		return str_split( $row );
	},
	$data
);

function get_scenic_score( $grid, $x, $y ) {
	$height = $grid[ $y ][ $x ];

	$north = $south = $east = $west = 0;

	for ( $i = $y + 1; $i < count( $grid ); $i++ ) {
		$south++;

		if ( $grid[ $i ][ $x ] >= $height ) {
			break;
		}
	}

	for ( $i = $y - 1; $i >= 0; $i-- ) {
		$north++;

		if ( $grid[ $i][ $x ] >= $height ) {
			break;
		}
	}

	for ( $i = $x + 1; $i < count( $grid ); $i++ ) {
		$east++;

		if ( $grid[ $y ][ $i ] >= $height ) {
			break;
		}
	}

	for ( $i = $x - 1; $i >= 0; $i-- ) {
		$west++;

		if ( $grid[ $y ][ $i ] >= $height ) {
			break;
		}
	}

	return $south * $north * $east * $west;
}

$scenic_scores = [];

foreach ( $grid as $y => $row ) {
	$dots[ $y ] = [];

	foreach ( $row as $x => $tree ) {
		$scenic_scores[] = get_scenic_score( $grid, $x, $y );
	}
}

echo max( $scenic_scores );
