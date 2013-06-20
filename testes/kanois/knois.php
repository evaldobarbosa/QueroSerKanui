<?
for ( $i = 1; $i < 101; $i++ ) {
  $display = $i;

	if ( ( $i % 5 == 0 ) && ( $i % 7 == 0 ) ) {
		$display = "KaNois";
	} else if ( $i % 5 == 0 ) {
		$display = "Ka";
	} else if ( $i % 7 == 0 ) {
		$display = "Nois";
	}

	echo "{$display}\n";
}
