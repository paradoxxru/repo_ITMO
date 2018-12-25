<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.12.2018
 * Time: 21:09
 */

$n = 10;
for($i=0;$i<$n;$i++) {
    if($i%2 == 1){

        continue;
        echo "Нечет: ";
    }
    echo "<p>";
    echo $i;
    echo "</p>";
}