<?
class NumberProcessor {
  private $letters = array();
	private $lineSize = 0;
	private $models = array(
		1 => '     |  |',
		2 => ' _  _||_ ',
		3 => ' _  _| _|',
		4 => '   |_|  |',
		5 => ' _ |_  _|',
		6 => ' _ |_ |_|',
		7 => ' _   |  |',
		8 => ' _ |_||_|',
		9 => ' _ |_| _|',
		0 => ' _ | ||_|'
	);

	function __construct($line1,$line2,$line3,$line4) {
		if ( !empty($line4) ) {
			throw Exception("Linha 4 deve ser vazia");
		}

		$this->lineSize = strlen($line1) - strlen($line1) % 3;

		for( $i = 0; $i < $this->lineSize; $i++ ) {
			$this->letters[] = substr( $line1, $i*3, 3 ) . substr( $line2, $i*3, 3 ) . substr( $line3, $i*3, 3 );
		}
	}

	function run() {
		$store = null;
		foreach ($this->letters as $key => $value) {
			$store .= array_search($value, $this->models);
		}

		return $store;
	}
}

$data = file_get_contents("digital_display_data.txt");
$num = new NumberProcessor(
	'    _  _     _  _  _  _  _  _ ',
	'  | _| _||_||_ |_   ||_||_|| |',
	'  ||_  _|  | _||_|  ||_| _||_|',
	''
);
echo $num->run(), "\n";
