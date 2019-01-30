<?php
// Разработать приложение Windows «Органайзер». Приложение предназначено для записи, 
// хранения и поиска адресов и телефонов физических лиц и организаций, а также расписания, 
// встреч и др. Приложение предназначено для любых пользователей компьютера. 

require_once('../lessonsPHP-master/app/dataio/CConfParser.php'); //подключили уже созданный класс для чтения
																// из файла
$config = CConfParser::getInstance('addresbook.yaml'); //в файле будет база

if(isset($_POST['contacts'])) {
	//сохранить массив $_POST['contacts'] в конфиг
	// $config->setAllParams();
	// $config->write();
} else {
	//это прямое обращение
	//прочитать данные из конфига и сформировать таблицу(через итерирование массива)
	$config->read();
	$contacts - $config->getAllParams();
	foreach ($contacts as $key => $value) {
		# code...
	}
}

//доделать - проверить git

?>


<table class='address-book'>
	<tr>
		<th>1</th>
		<th>Имя</th>
		<th>Телефон</th>
		<th>почта</th>
		<th>Адрес</th>
	</tr>
	<tr>
		<td>2</td>
		<td>Василий</td>
		<td>555-55-55</td>
		<td>email@mail.ru</td>
		<td>Адрес 22, кв. 13</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Петр</td>
		<td>666-55-55</td>
		<td>email@gmail.ru</td>
		<td>Адрес 98, кв. 34</td>
	</tr>
</table>
<button class="add-contact">Добавить контакт</button>
<button class="save-contact">сохранить контакт</button>

<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.add-contact').on('click', function(){
			//alert('ddfff');
			$('table.address-book').append('<tr><td></td><td></td><td></td><td></td><td></td></tr>');
		})
		$(document).on('click','table.address-book td', function(){
			if ($(this).find('input').length == 0) {
				val = $(this).text();
				input = $(this).html("<input value='" + val + "'/>");
			}
		});
		$(document).on('focusout','table.address-book td input', function(){
			val = $(this).val();
			$(this).closest('td').text(val);
		});

		$(document).on('click','button.save-contact', function(){
			pst = [];
			$('table tr').foreach(function(el){
				row = el.find('td');
				if(row.length > 0) {
					pst.push({
						'number': $(row[0]).text(),
						'fio': $(row[0]).text(),
						'tel': $(row[0]).text(),
						'email': $(row[0]).text(),
						'address': $(row[0]).text(),
					});
				}
			})
			$.post(document.location.href, pst, function(data){
				console.log(data);
				console.log('sucsses');
			});
		});
	});
</script>
