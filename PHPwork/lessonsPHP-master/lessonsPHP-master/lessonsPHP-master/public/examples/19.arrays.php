<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 17.01.2019
 * Time: 18:51
 */

$user1 = "Иванов Иван Иванович";
$user2 = "Васильев Василий Васильевич";
$user3 = "Константинов Константин Константинович";
$users = [
    "Иванов Иван Иванович",
    "Васильев Василий Васильевич",
    "Константинов Константин Константинович"
];
$i = 0;
?>

<table>
    <tr>
        <th>#</th>
        <th>ФИО</th>
    </tr>



    <?php

        for($i = 0; $i < count($users); $i++) {
            // todo 0, 1, 2
            // todo разбить строку по пробелу
            // todo обратиться к первому элементу нового массива (фамилия)
            // todo берем первую букву второго элемента
            // todo берем первую букву третьего элемента
            // todo соединяем с точками после И и О и выводим
            explode($delimiter, $string);
            $string[0];
            mb_substr($string, $start_position, $length);

            echo "<tr>"
                . "<td>" . ($i + 1) . "</td>"
                . "<td>" . mb_strtoupper($users[$i]) . "</td>"
                . "</tr>";
        }

    ?>
</table>
