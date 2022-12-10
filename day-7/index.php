<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

$root = [];

$dir = [
	'/' => &$root,
];

$command   = '';
$parameter = '';
$path      = '.';

foreach ( $data as $line ) {
	if ( str_starts_with( $line, '$' ) ) {
		$n = sscanf( $line, '$ %s %s', $command, $parameter );

		if ( 'cd' === $command ) {
			$dir = &$dir[ $parameter ];
		}

		continue;
	}

	if ( 'ls' === $command ) {
		$n = sscanf( $line, '%s %s', $info, $name );

		if ( 'dir' === $info ) {
			$dir[ $name ] = [
				'..' => &$dir,
			];
		} else {
			$dir[ $name ] = $info;
		}
	}
}

function dir_size( $dir, $map = [], $path = '' ) {
	$map[ $path ] = 0;

	foreach ( $dir as $key => $item ) {
		if ( '..' === $key ) {
			continue;
		}

		if ( is_array( $item ) ) {
			$sub = $path . '/' . $key;

			$map = dir_size( $item, $map, $sub );

			$map[ $path ] += $map[ $sub ];
		} else {
			$map[ $path ] += $item;
		}
	}

	return $map;
}

$map = dir_size( $root );

foreach( $map as $key => $value ){
    echo $key, ' - ', $value, PHP_EOL;
}

$dirs = array_filter(
	$map,
	function( $size ) {
		return $size < 100000;
	}
);

echo array_sum( $dirs );
