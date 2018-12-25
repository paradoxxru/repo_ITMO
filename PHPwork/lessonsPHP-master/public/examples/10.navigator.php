<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.12.2018
 * Time: 19:37
 */

$path = "./";
if(isset($_GET['path'])) {
    if(is_dir($_GET['path'])) {
        $path = $_GET['path'] . '/';
    }
}

$folder = opendir($path);
if($folder) {
    echo "<table>"; //todo <table><tr><td>
    while($file = readdir($folder)) {
        echo '<tr>';
        if(is_dir($path . $file)) {
            echo "<td colspan='4'>";
            $full_file_name = $path . $file;
            echo "<a href='/index.php?path={$full_file_name}'>{$file}</a>";
            echo "</td>";
        } else {
            echo "<td>";
            echo $file;
            echo "</td><td>";
            echo filesize($path . $file);
            echo "</td><td>";
            $file_info = pathinfo($path . $file);
            echo $file_info['extension'];
            echo "</td><td>";
            $file_time = filemtime($path . $file);
            echo date("Y-m-d H:i:s", $file_time);
            echo "</td>";

        }
        //todo filesize($path_to_file)
        //todo pathinfo($path_to_file)

        echo '</tr>';
    }
    echo "</table>";
}
