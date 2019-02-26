// $(document).ready(function() {
// 	console.log($('.slider'));
// 	 $(".slider").each(function () { // обрабатываем каждый слайдер
// 		  var obj = $(this);
// 		  $(obj).append("<div class='nav'></div>");
// 		  $(obj).find("li").each(function () {
// 		   $(obj).find(".nav").append("<span rel='"+$(this).index()+"'></span>"); // добавляем блок навигации
// 		   $(this).addClass("slider"+$(this).index());
// 		  });
// 		  $(obj).find("span").first().addClass("on"); // делаем активным первый элемент меню
// 	 });
// });
// function sliderJS (obj, sl) { // slider function
// 	 var ul = $(sl).find("ul"); // находим блок
// 	 var bl = $(sl).find("li.slider"+obj); // находим любой из элементов блока
// 	 var step = $(bl).width(); // ширина объекта
// 	 $(ul).animate({marginLeft: "-"+step*obj}, 500); // 500 это скорость перемотки
// }
// $(document).on("click", ".slider .nav span", function() { // slider click navigate
// 	 var sl = $(this).closest(".slider"); // находим, в каком блоке был клик
// 	 $(sl).find("span").removeClass("on"); // убираем активный элемент
// 	 $(this).addClass("on"); // делаем активным текущий
// 	 var obj = $(this).attr("rel"); // узнаем его номер
// 	 sliderJS(obj, sl); // слайдим
// 	 return false;
// });

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
	// Галлерея
	if($("#gallery").length){ //проверка есть ли элементы списка
		var totalImages = $("#gallery > li").length; //сколько всего элементов списка(картинок)
		//imageWidth полная ширина элемента
		var imageWidth = $("#gallery > li:first").outerWidth(true); //outerWidth - ширина элемента
		// (элемент + padding + border) , а если outerWidth(true) - это еще + margin
		console.log('полная ширина элемента :'+ imageWidth);
		var totalWidth = imageWidth * totalImages;//полная ширина галереи
		console.log('полная ширина галереи: '+ totalWidth);
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

});