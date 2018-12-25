<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 06.12.2018
 * Time: 13:37
 */

/**
 * @param $i
 * @return string
 */
function getCardValue($i) {
    if(!is_int($i))
        return "Требуется номер карты";
    if( $i < 1 || $i > 52)
        return "Нет такой карты";
    $suit = "Ч";
    $val = "T";
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
    switch(ceil($i / 13)) {
        case 1:
            $suit = "hearts";
            break;
        case 2:
            $suit = "diamonds";
            break;
        case 3:
            $suit = "clubs";
            break;
        case 4:
            $suit = "spades";
            break;
    }

    return "<span class=\"{$suit}\">{$val}</span>";
}

$i = rand(0, 53);
$i = 39;
$card = getCardValue($i);
echo $i . ": " . $card;

?>
<style type="text/css">
    .hearts, .diamonds {color:red;}
    .clubs, .spades {color:black;}
    .hearts::before{content:"♥";}
    .diamonds::before{content:"♦";}
    .clubs::before{content:"♣";}
    .spades::before{content:"♤";}
</style>



