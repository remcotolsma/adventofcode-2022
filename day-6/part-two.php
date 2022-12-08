<?php

$datastream = file_get_contents( 'input.txt' );

$distinct = 14;

$offset = 0;

do {
	$four_characters = substr( $datastream, $offset, $distinct );

	$unique_characters = count_chars( $four_characters, 1 );

	if ( $distinct === count( $unique_characters ) ) {
		echo ( $offset + $distinct );

		break;
	}

	$offset++;
} while ( '' !== $four_characters );
