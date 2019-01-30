<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 22.12.2018
 * Time: 12:26
 */


echo "<pre>";
echo print_r($_FILES, true);
if(isset($_FILES['userfile'])) {
    foreach ($_FILES['userfile']['name'] as $key => $name) {
        $file_info = pathinfo($name);
        if($file_info['extension'] == "css") {
            $destination = "./css/" . microtime(true) . ".css";
            move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
        } elseif ($file_info['extension'] == "jpg") {
            $destination = "./img/" . microtime(true) . ".jpg";
            move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $destination);
        } else echo "incorrect extension {$file_info['extension']}" . PHP_EOL;
    }
//    $file_info = pathinfo($_FILES['userfile']['name']);
//    $destination = "../data/" . microtime(true) . "." . $file_info['extension'];
//    echo $destination;
//    move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
} else echo "not isset files";

echo "</pre>";

?>
<form enctype="multipart/form-data" action="13.file_upload.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    Отправить этот файл: <input name="userfile[]" multiple type="file" />
    <input type="submit" value="Send File" />
</form>

