<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

$grid = array_map(
	function( $row ) {
		return str_split( $row );
	},
	$data
);

function get_status( $grid, $x, $y ) {
	$tree = $grid[ $y ][ $x ];

	if ( 0 === $x ) {
		return 'E';
	}

	if ( 0 === $y ) {
		return 'E';
	}

	if ( array_key_last( $grid ) === $y ) {
		return 'E';
	}

	if ( array_key_last( $grid[ $y ] ) === $x ) {
		return 'E';
	}

	$height = count( $grid );
	$width  = count ( $grid[ $y ] );

	$protected = 0;

	// up
	for ( $i = 0; $i < $y; $i++ ) {
		if ( $grid[ $i ][ $x ] >= $tree ) {
			$protected++;

			break;
		}
	}

	// down
	for ( $i = $height - 1; $i > $y; $i-- ) {
		if ( $grid[ $i ][ $x ] >= $tree ) {
			$protected++;

			break;
		}
	}

	// left
	for ( $i = 0; $i < $x; $i++ ) {
		if ( $grid[ $y ][ $i ] >= $tree ) {
			$protected++;

			break;
		}
	}

	// right
	for ( $i = $width - 1; $i > $x; $i-- ) {
		if ( $grid[ $y ][ $i ] >= $tree ) {
			$protected++;

			break;
		}
	}

	return $protected;
}

$dots = [];

$visible = 0;

foreach ( $grid as $y => $row ) {
	$dots[ $y ] = [];

	foreach ( $row as $x => $tree ) {
		$status = (string) get_status( $grid, $x, $y );

		$dots[ $y ][ $x ] = ( '4' === $status ) ? '🏡' : '🎄';

		if ( '4' !== $status ) {
			$visible++;
		}
	}
}

foreach ( $dots as $row ) {
	foreach ( $row as $dot ) {
		echo $dot;
	}

	echo PHP_EOL;
}

echo $visible;
