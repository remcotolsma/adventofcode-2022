<?php

$datastream = file_get_contents( 'input.txt' );

$offset = 0;

do {
	$four_characters = substr( $datastream, $offset, 4 );

	$unique_characters = count_chars( $four_characters, 1 );

	if ( 4 === count( $unique_characters ) ) {
		echo ( $offset + 4 );

		break;
	}

	$offset++;
} while ( '' !== $four_characters );
