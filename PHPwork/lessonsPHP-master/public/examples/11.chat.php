<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.12.2018
 * Time: 21:06
 */
$user_name = "anon";
if(isset($_POST['login'])) $user_name = $_POST['login'];


?>
    <div class="message-box">
        <?php
        // Вывод предыдущих сообщений из чата
        $messages = file('history.txt');
        foreach($messages as $mes) {
            echo "<p>" . $mes . "</p>";
        }
        // Обработка текущего сообщения
        if(isset($_POST['message']) && strlen($_POST['message'])>0) {
            $mes = $user_name .
                " (" . date("H:i:s") . "): " .
                $_POST['message'];
            file_put_contents('history.txt',
                $mes . PHP_EOL,
                FILE_APPEND);
            echo "<p>" . $mes . "</p>";
        }
        ?>
    </div>
    <form method="post" action="index.php">
        <input
            name="login"
            type="text"
            value="<?php echo $user_name; ?>"
        /><br/>
        <textarea name="message" rows="4" cols="10"></textarea></br>
        <button>Отправить</button>
    </form>

<?php
echo "<pre>" . print_r($_POST, true) . '</pre>';
