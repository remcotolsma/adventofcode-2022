<?php

$data = file( 'input.txt', FILE_IGNORE_NEW_LINES );

function range_flat( $range ) {
	list( $start, $end ) = explode( '-', $range );	

	return range( $start, $end );
}

$total = 0;

foreach ( $data as $line ) {
	list( $elf_1, $elf_2 ) = explode( ',', $line );

	$elf_1_ids = range_flat( $elf_1 );
	$elf_2_ids = range_flat( $elf_2 );

	$intersect = array_intersect( $elf_1_ids, $elf_2_ids );

	if ( count( $intersect ) > 0 ) {
		$total++;
	}
}

echo $total;
