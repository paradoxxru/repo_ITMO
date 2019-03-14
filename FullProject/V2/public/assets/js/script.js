$(document).ready(function(){ 
	// Галлерея
	if($("#gallery").length){ //проверка есть ли элементы списка
		var totalImages = $("#gallery > li").length; //сколько всего элементов списка(картинок)
		//imageWidth полная ширина элемента
		var imageWidth = $("#gallery > li:first").outerWidth(true); //outerWidth - ширина элемента
		// (элемент + padding + border) , а если outerWidth(true) - это еще + margin
		//console.log('полная ширина элемента :'+ imageWidth);
		var totalWidth = imageWidth * totalImages;//полная ширина галереи
		//console.log('полная ширина галереи: '+ totalWidth);
		var visibleImages = Math.round($("#slider-wrap").width() / imageWidth); //берем ширину видимой области
		// и делим на ширину элемента, округляем к ближайшему цнлому - получили сколько элементов влезет в видимую область
		var visibleWidth = visibleImages * imageWidth; //ширина всех видимых элементов(картинок)
		var stopPosition = (visibleWidth - totalWidth); //позиция останова прокрутки

		$("#gallery").width(totalWidth); //установить ширину галереи

// do while - сделать сомоменяющиеся слайды до клика по ним или по стрелкам
		
		
		$("#control-prev").click(function(){
			//проверяем позицию галереи по левому краю и не анимируется ли сейчас галерея(нужно 
			// чтобы не "пролетало", так как на анимацию затрачивается время, а пользователь может быстро нажимать
			// на кнопку)
			if($("#gallery").position().left < 0 && !$("#gallery").is(":animated")) {
				//leftposition += imageWidth;
				$("#gallery").animate({left : '+=' + imageWidth}); //{left : '+=' + imageWidth} - сначала 
				// вычисляется текущее значение left, а затем к нему прибавляется imageWidth
			}
			return false;
		});

		$('#control-next').click(function(){
			if($("#gallery").position().left > stopPosition && !$("#gallery").is(":animated")) {
				//leftposition -= imageWidth;
				$('#gallery').animate({left : '-=' + imageWidth});
			}
		});
		
	}

	//в личном кабинете - если у элемента есть класс select, то меняем цвет ссылки на белый
	var element = $('.cabinet__links').find('li');
	// console.log('какой элемент нашли');
	// console.log(element);
	var len_elem = element.length;
	// console.log('длина :' + len_elem);
	for(var i=0; i< len_elem; i++) {
		// console.log('element[i]');
		// console.log(element[i]);
		var li = element[i];
		if($(li).hasClass('select')) {
			var a = $(element[i]).children()[0];
			$(a).css({'color': '#fff'});
		}
	}
	
	//обработка клика на ссылки с классом "do-action"
	$(document).on('click','.do-action', function(e){
		e.preventDefault();
		var click = this;
		console.log('работает action- положить товар в корзину');
		var href = $(this).attr('href');
		console.log(href);
		var params = href.split('&');
		console.log(params);
		var result = [];
		for(var i=1; i<params.length; i++) {
			var item = params[i].split('=');
			result[item[0]] = item[1];
		}
		console.log(result);
		var id = result['id'];
		var action = result['action'];
		var cost = result['cost'];
		var weight = result['weight'];
		console.log('надо сделать экшн: ' + action + ' с товаром с id = ' + id);

		//сделать аякс запрос
		$.post(params[0],
			{message: 'запрос через аякс', action: action, id: id, cost: cost, weight: weight}, function(data){
			console.log('получили ответ');
			console.log(data);
			data = JSON.parse(data);
			console.log('data после JSON.parse(data)');
			console.log(data);
			$('#TotalCount').text(data['totalCount']);
			$('#TotalCost').text(data['totalCost']);
			console.log('click - this');
			console.log($(click));
			console.log('получить родителя родителя');
			console.log($(click).parent().parent());
			if($(click).parent().parent().hasClass('cart__item-cost_count')) {//если кликали из корзины
				var idSummCost = '#SummCost'+id;
				var idSummCount = '#SummCount'+id;
				$(idSummCost).html('<b>Стомость: </b><br>'+ data['count_in_cart']*cost);
				$(idSummCount).html('<b>Кол-во: </b>' + data['count_in_cart']);
				$('#TotalCost2').text('Общая стоимость: ' + data['totalCost'] + ' руб.');
				$('#TotalWeight').text('Общая вес: ' + (data['totalWeight']/1000) + ' кг.');
				//если кол-во товара в корзине > товара в базе, то изменить цвет
				var idInStok = '#InStok'+id;
				// console.log('в базе товара: '+ data['goodsCountInBase']);
				// console.log('тип goodsCountInBase:' + typeof(data['goodsCountInBase']));
				// console.log('в корзине товара: ' + data['count_in_cart']);
				// console.log('тип data[count_in_cart]: ' + typeof(data['count_in_cart']));
				if(parseInt(data['count_in_cart']) > parseInt(data['goodsCountInBase'])) {
					$(idInStok).css({'color': 'red'});
				} else {
					$(idInStok).css({'color': 'black'});
				}
			}
			if(action === 'del_element') { // может поднять выше
				//если нажали удалить позицию из корзины, то прячем элемент
				var idCartItem = '#CartItem'+id;
				$(idCartItem).css({'display': 'none'});
				$('#TotalCost2').text('Общая стоимость: ' + data['totalCost'] + ' руб.');
				$('#TotalWeight').text('Общая вес: ' + (data['totalWeight']/1000) + ' кг.');
			}
			
		});
	});

});

//ф-ция получает имя загружаемого файла и выводит в нужное место
function getFileName () {
var file_name = $('#Uploaded').val();//document.getElementById ('Uploaded').value;
console.log('file_name : '+ file_name);
file_name = file_name.split('\\').pop(); //разделили по \, затем взяли последний элемент
console.log('file_name после сплита : '); console.log(file_name);
//file_name = file.replace (/\\/g, «/»).split ('/').pop ();
$('#FileName').html('Имя файла: ' + file_name);
}