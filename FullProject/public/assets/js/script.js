var anchor;
//получаем строку с параметрами из запроса(?q=catalog&id=25&weight=1800&cost=520&action=addtocart&anchor=anchor25a)
var loc_search = $(location).attr('search');
//обрезаем по знак ?(q=catalog&id=25&weight=1800&cost=520&action=addtocart&anchor=anchor25a)
var str = loc_search.split('?')[1];
//разбиваем строку(по &) на массив подстрок
if(str !== undefined) {
	var str2 = str.split('&');
	var len = str2.length;
	// console.log(loc_search);
	// console.log(str);
	// console.log(str2);
	var arr_param = [];
	if(str2 !== undefined) {
		for(var i=0; i<len; i++) {
			//разбиваем каждую строку массива на подстроки по =
			var params = str2[i].split('=');
			arr_param[params[0]] = params[1];//на всякий случай делаем массив параметров
			//проверяем есть ли среди параметров anchor и если есть берем его значение
			if(params[0] === 'anchor'){
				anchor = params[1];
			}
		}
	}
}
// console.log(arr_param);
// console.log('выводим якорь')
// console.log(anchor);
// if () {
// 	console.log();
// 	var anchor = $_GET['anchor'];
// }
$(document).ready(function(){ 
	//сделать вставку в li нужных элементов(вернуть из php по запросу из базы)
	//var new_gallery = $('#gallery');
	//new_gallery.empty();
	// for(var i=1;i<15;i++) {
	// 	$('#gallery').append($('<li>',{
	// 		append: $('<a>',{href:"#",
	// 					append: $('<img>',{src:'img/goods/' + i + '.jpg'})
	// 				})
	// 		}));
	// }
	// var loc = $(location.hash);
	// var anchor = loc.attr('id');
	// if(anchor) {
	// 	location.hash = anchor;
	// }
	//window.scrollTo(loc);
	// console.log(loc);
	// console.log(anchor);
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
	//если в get параметрах был "якорь", то переходим к нему
	if(anchor) {
		location.hash = anchor;
	}

	//меняем класс для подсветки вкладок("История покупок" и "Личные данные")
	

});