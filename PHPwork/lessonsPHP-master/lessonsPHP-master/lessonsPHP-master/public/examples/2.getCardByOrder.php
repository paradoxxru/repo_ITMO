<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.12.2018
 * Time: 21:08
 */

function getCardValue($i) {
    if(!is_int($i))
        return "Требуется номер карты";
    if( $i < 1 || $i > 52)
        return "Нет такой карты";
    $suit = "Ч";
    $val = "T";
    switch(ceil($i / 13)) {
        case 1:
            $suit = "Ч";
            break;
        case 2:
            $suit = "Б";
            break;
        case 3:
            $suit = "Т";
            break;
        case 4:
            $suit = "П";
            break;
    }
    switch ($i % 13) {
        case 0:
            $val = "К";
            break;
        case 1:
            $val = "Т";
            break;
        case 11:
            $val = "В";
            break;
        case 12:
            $val = "Д";
            break;
        default:
            $val = $i % 13;
    }
    return $suit . $val;
}

$i = rand(0, 53);
$i = 39;
$card = getCardValue($i);
echo $i . ": " . $card;