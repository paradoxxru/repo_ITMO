<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.12.2018
 * Time: 20:50
 */


function getLightColor($i) {
    if(!is_int($i)) return "Ошибка";
    if($i < 0) return "Ошибка";
    $i = $i % 60;
    // green 3
    // y 3
    // r 4
    // y 2
    $color = "";
    $i = $i % 12;
    if($i < 3) $color = "green";
    elseif ($i < 6) $color = "yellow";
    elseif ($i < 10) $color = "red";
    else $color = "yellow";


/*
    switch($i) {
        case 0:
        case 1:
        case 2:
            $color = "green";
            break;
        case 3:
        case 4:
        case 5:
        case 10:
        case 11:
            $color = "yellow";
            break;
        case 6:
        case 7:
        case 8:
        case 9:
            $color = "red";
            break;
    }
/**/
    return $color;
}

$i = rand(0, 60);
$i = 46;
$color = getLightColor($i);
echo $i . ": " . $color . "<br/>";

$b = true;
echo ($b ? "true" : "false");
var_dump($b);