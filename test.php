<?php
class doc {
	private $_text;

	public function getText(){
		$this->_text;
	}

	public function setTextt($text){
		$this->_text=$text;
	}
}

$d=new doc();
$d->text1='hello';

echo $d->text1;
//phpinfo();