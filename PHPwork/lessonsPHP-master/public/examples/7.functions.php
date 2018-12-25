<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.12.2018
 * Time: 15:11
 */

/**
 * Функция, принимающая аргумент по ссылке
 * @param $output
 * @param $str
 */
function concat(&$output, $str) {
    $output .= $str;
}

/**
 * Функция, принимающая аргумент по значению
 * @param $output
 * @param $str
 */
function concat2($output, $str) {
    $output .= $str;
    echo $output . "\n";
}

// Проверка влияния на исходное значение переменной ее передача в вызовы функций по ссылке или по значению
echo '<pre>';
$str = 'Hello';
echo $str . "\n";
concat($str, ' world!');
echo $str . "\n";
concat2($str, ' world!');
echo $str . "\n";
echo '</pre>';