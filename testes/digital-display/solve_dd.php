<?
class NumberProcessor {
	private $numbers = array();
	private $lineSize = 0;
	private $models = array(
		' _ | ||_|',
		'     |  |',
		' _  _||_ ',
		' _  _| _|',
		'   |_|  |',
		' _ |_  _|',
		' _ |_ |_|',
		' _   |  |',
		' _ |_||_|',
		' _ |_| _|'
	);

	function __construct($line1,$line2,$line3,$line4) {
		$line4 = trim($line4);
		
		if ( strlen($line4) !== 0 ) {
			throw new Exception("Linha 4 deve ser vazia");
		}

		$this->lineSize = strlen($line1) - strlen($line1) % 3;

		for( $i = 0; $i < $this->lineSize; $i++ ) {
			$this->numbers[] = substr( $line1, $i*3, 3 ) . substr( $line2, $i*3, 3 ) . substr( $line3, $i*3, 3 );
		}
		
	}

	function run() {
		$store = null;
		foreach ($this->numbers as $key => $value) {
			if ( in_array($value, $this->models) ) {
				$store .= array_search($value, $this->models);
			//} else {
			//	$store = '/!\\erro de formato/!\\';
			//	break;
			}
		}

		return $store;
	}
}

$data = file("digital_display_data.txt");
echo "==========\nBASE NUMBERS\n==========\n";
$num = new NumberProcessor(
	'    _  _     _  _  _  _  _  _ ',
	'  | _| _||_||_ |_   ||_||_|| |',
	'  ||_  _|  | _||_|  ||_| _||_|',
	''
);
echo $num->run(), "\n";
echo "==========\nTESTING WRONG\n==========\n";
$num = new NumberProcessor(
	'    _  _     _  _  _  _  _  _ ',
	'  | _| _||_||_ |_   /|_||_|| |',
	'  ||_  _|  | _||_|  ||_| _||_|',
	''
);
echo $num->run(), "\n";
echo "==========\nPROCESSING THE FILE\n==========\n";

$num = new NumberProcessor(
	$data[0],
	$data[1],
	$data[2],
	$data[3]
);

$line_count = round( count($data) / 4 );

for( $i = 0; $i < $line_count; $i++ ) {
	$l1 = $data[ $i * 4 ];
	$l2 = $data[ $i * 4 + 1 ];
	$l3 = $data[ $i * 4 + 2 ];
	$l4 = ( isset($data[ $i * 4 + 3 ]) )
		? $data[ $i * 4 + 3 ]
		: '';
	$num = new NumberProcessor(
		$l1,
		$l2,
		$l3,
		$l4
	);
	echo $num->run(), "\n";
}
