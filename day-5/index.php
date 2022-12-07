<?php

$data = file_get_contents( 'input.txt' );

list( $stacks_string, $procedure_string ) = explode( "\n\n", $data );

$stacks = [];

$rows = array_map(
	function( $row ) {
		return array_map(
			function( $cell ) {
				return trim( $cell, ' []' );
			},
			str_split( $row, 4 )	
		);
	},
	explode( "\n", $stacks_string )
);

$index = array_pop( $rows );

foreach ( $index as $key => $name ) {
	$stacks[ $name ] = [];
}

foreach ( $rows as $row ) {
	foreach ( $index as $key => $name ) {
		$value = $row[ $key ];

		if ( '' !== $value ) {
			array_unshift( $stacks[ $name ], $value );
		}
	}
}

var_dump( $stacks );
