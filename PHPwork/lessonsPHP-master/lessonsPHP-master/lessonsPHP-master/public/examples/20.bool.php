<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 19.01.2019
 * Time: 11:08
 */

//Первый уходит в 9-30, а приходит в 18-30.
//Второй уходит в 12-30, а приходит в 19-30.
//Третий уходит в 21-30, а приходит в 7-30.
function has1($h) {
    $in_home = ($h <= 9) || ($h > 18);
    return $in_home;
}
function has2($h) {
    return ($h <= 12) || ($h > 18);
}
function has3($h) {
    return ($h > 7) && ($h < 21);
}

function hasSomeBody($h) {
    return has1($h) || has2($h) || has3($h);
}