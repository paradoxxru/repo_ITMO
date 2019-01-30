<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 22.12.2018
 * Time: 11:22
 */
$sec = (int)date('s');
$sec = 53;
echo $sec . PHP_EOL;
$tablo = [];
$tablo[] = '\\\\\\\\\\\\||||//////';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '\              /';
$tablo[] = '-              -';
$tablo[] = '-      ┌┐      -';
$tablo[] = '-      └┘      -';
$tablo[] = '-              -';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '/              \\';
$tablo[] = '//////||||\\\\\\\\\\\\';

$tablo_out = [];
for($i=0; $i<16; $i++) {
    for($k=0; $k<16; $k++) {
        $tablo_out[$i][$k] = " ";
    }
}

$side = (floor(($sec + 8) / 15)) % 4;
echo $side;
switch($side) {
    case 0:
        $i = 0;
        // todo $sec + 8 = {61 до 68 и от 9 до 16}
        $k = ($sec + 8) % 60 - 1;
        break;
}

$tablo_out[$i][$k] = $tablo[$i][$k];

echo "<pre>";

foreach ($tablo_out as $key => $row) {
    foreach ($row as $symb) {
        echo $symb;
    }
    echo  PHP_EOL;
}
//echo print_r($tablo, true);


echo "<pre>";
