<?php

class CYamlParserForCart extends CConfParser
{
	private $lines; // массив строк
    private $i; // счетчик
    private $total_lines; //длина массива строк
    public function read() {
    	$this->lines = file($this->source);
    	$this->total_lines = count($this->lines);
    	for($this->i = 0; $this->i < $this->total_lines; $this->i++) {
    		$line = trim($this->lines[$this->i]);
    		$vals = explode(';', $line);
    	}
    }
    private function getValue($val, $level) {

    }
    public function write() {

    }
    private function valueToYaml($key, $val, $indent = "") {

    }
}