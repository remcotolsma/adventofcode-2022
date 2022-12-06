<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

function range_flat( $range ) {
	list( $start, $end ) = explode( '-', $range );	

	$sections = range( $start, $end );

	return '-' . implode( '-', $sections ) . '-';
}

$total = 0;

foreach ( $data as $line ) {
	list( $elf_1, $elf_2 ) = explode( ',', $line );

	$elf_1_ids = range_flat( $elf_1 );
	$elf_2_ids = range_flat( $elf_2 );

	if ( str_contains( $elf_1_ids, $elf_2_ids ) || str_contains( $elf_2_ids, $elf_1_ids ) ) {
		$total++;
	}
}

echo $total;
