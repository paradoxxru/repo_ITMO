<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.03.2019
 * Time: 18:37
 */

// Так можно без дополнительных параметров отличить запросы через аякс
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    // Если аякс, то надо отдать только конкретные данные - этот вопрос можно в роутинге решать
    if(isset($_POST['result_type']) && $_POST['result_type'] === "json") {
        $result = [
            'html' => "<h2>Было получено сообщение</h2><p>" . $_POST['message'] . "</p>",
            'params' => "Еще что-то"
        ];
        // Преобразуем массив в json
        $result = json_encode($result);
        echo $result;
        // можно выводить через die("Текстовая строка") - эта команда отправляет в поток принятый аргумент и прекращает выполнение скрипта
    } else {
        echo "<h2>Было получено сообщение</h2><p>" . $_POST['message'] . "</p>";
    }
} else { // Если не аякс, то запускаем обычный обработчик
?>
<html>
<head></head>
<body>
<p>Запросы</p>
<a href="/sample.php" class="ajax">Ajax с html в результате</a><br>
<a href="/sample.php" class="ajax json">Ajax с json в результате</a>
<p>Результат:</p>
<div class="result"></div>
<p>Результат (pre):</p>
<pre class="result-pre"></pre>
<script src="js_for_sample/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
        console.log('11111');
        $(document).on('click', 'a.ajax', function(e){
            e.preventDefault();
            // Определяем параметр, чтобы сообщить серверу, какой результат хотим получить
            var type = $(this).hasClass('json') ? 'json' : 'html';
            $.post('/sample.php', {message: "Этот запрос сделан через ajax", result_type: type}, function (data){
                console.log('выводим data');
                console.log(data);
                // Преобразовать текстовый json результат в объект
                if(type == "json") {
                    $('.result-pre').text(data);
                    data = JSON.parse(data);
                    $('.result').html(data.html);
                    console.log('выводим data после парсинга');
                    console.log(data);
                } else {
                    $('.result').html(data);
                    $('.result-pre').text(data);
                }
            });
        })
    });
</script>
</body>
</html>

<?php
}