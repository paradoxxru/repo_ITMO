<?php

define('OUR_TEST', 'our_test');
$our_test = isset($our_test) ? $our_test++ : 1;
$our_tesT = isset($our_test) ? $our_test++ : 2;
function getCurrentDir() {
	return __DIR__;
}
function getRealPath() {
	return realpath('./');
}
function getScriptInfo() {
	echo __DIR__.PHP_EOL,
		__FILE__.PHP_EOL,
		__FUNCTION__.PHP_EOL,
		__LINE__.PHP_EOL
		;
}

?>