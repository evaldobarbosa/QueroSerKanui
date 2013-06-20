<?
//$phrase = "The quick brown fox jumps over the lazy dog, the dog runs scared.";
$phrase = file_get_contents("data.txt");
$phrase = strtolower($phrase);

$drop_little_words = true;
$replace_contractions = true;

if ($replace_contractions) {
  $phrase = replace_all_contractions($phrase);
}

$ex = preg_split("([^a-z]+)", $phrase);

$rank = array();

foreach( $ex as $word ) {
	if ( empty($word) ) {
		continue;
	}

	if ( $drop_little_words && strlen($word) == 1 ) {
		continue;
	}
	
	if ( !isset($rank[ $word ]) ) {
		$rank[ $word ] = 1;
	} else {
		$rank[ $word ]++;
	}
}

ksort( $rank );

$classified = array();

foreach( $rank as $key=>$value ) {
	if ( !isset($classified[$value]) ) {
		$classified[$value] = array();
	}

	$classified[$value][] = $key;
}

krsort($classified);

$rank = array();
foreach ($classified as $key => $value) {
	asort($value);
	foreach ($value as $k1 => $v1) {
		$rank[ $v1 ] = $key;
	}
}

foreach( $rank as $key=>$value ) {
	echo "{$key} = {$value}\n";
}

function replace_all_contractions($data) {
	$data = str_replace("don’t", "do not", $data);
	$data = str_replace("they’re", "they are", $data);
	$data = str_replace("you’re", "you are", $data);
	$data = str_replace("haven’t", "have not", $data);
	$data = str_replace("aren’t", "are not", $data);

	return $data;
}
