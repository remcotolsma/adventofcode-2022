<?php

$handle = fopen( 'input.txt', 'r' );

if ( false === $handle ) {
	echo 'Cannot read input.text';

	exit( 1 );
}

$most  = 0;
$total = 0;

while ( ( $line = fgets( $handle ) ) !== false ) {
	$value = trim( $line );

	if ( '' === $value ) {
		$most = max( $most, $total );

		$total = 0;
	}

	$total += (int) $value;
}

echo $most, PHP_EOL;

fclose( $handle );
