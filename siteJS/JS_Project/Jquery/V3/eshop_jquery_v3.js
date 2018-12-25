var catalog; //будет содержать ссылку на элемент <div class="catalog">
var class_basket; //будет содержать ссылку на элемент <div class="basket">
var result_search; // будет содержать ссылку на элемент <div class="result_search">
var filter_categories; //будет содержать ссылку на элемент <ul class="filter__categories">
var filter_cost;	//будет содержать ссылку на элемент <ul class="filter__cost">
var filter_weight; //будет содержать ссылку на элемент <ul class="filter__weight">
var filter_popularity; // будет содержать ссылку на элемент <ul class="filter__popularity">
var cats; //массив будет содержать названия катигорий товаров и кол-во товара данной категории
var basket = []; // ассоц.массив товаров в корзине. будет содержать ключ-имя товарова, значение - объект с полями:
                 //count- кол-во, cost- цена, weight- вес, idElement- id товара
// var actions = {//объект действий при клике на разные элементы - его поля соответствуют значениям атрибутов data-action
// 	filter: filterBy,
// 	show_basket: showBasket,	//значение полей это ссылки на ф-ции
// 	put_in_basket: putInBasket,
// 	show_one_item: showOneItem,
// 	minus_ItemBasket: minusItemBasket,
// 	plus_ItemBasket: plusItemBasket,
// 	del_element_basket: delElementBasket,
// 	full_goods: printFullListGoods,
// }
var goods; //массив объектов(товаров) - будем получать через AJAX запрос

$(document).ready(function(event) {
	catalog = $('.catalog').first();
	class_basket = $('.basket').first();
	result_search = $('.result_search').first();
	catalog.empty();
	class_basket.empty();
	result_search.empty();
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
		}
		//goods[0].name = "gowww";
		//goods[9].name = "go2";
		//goods[8].name = "go4";
		console.log(goods);
		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);

				//обработка списка фильтрации по категориям
		filter_categories = $('.filter__categories').first();//получаем ссылку на тэг <ul class="filter__categories">
		filter_categories.empty(); //чистим список по категориям
		//заполняем фильтр по категориям <ul class="filter__categories">
		fillingFilterByCategory();
				//обработка списка фильтрации по стоимости
		filter_cost = $('.filter__cost').first(); 
		filter_cost.html(''); // можно использовать вместо .empty()
		//заполняем фильтр по стоимости(больше/меньше 10000) <ul class="filter__cost">
		fillingFilterByCost();
				//обработка списка фильтрации по весу
		filter_weight = $('.filter__weight').first(); 
		filter_weight.html('');
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByWeight();
				//обработка списка фильтрации по популярности
		filter_popularity = $('.filter__popularity').first(); 
		filter_popularity.html('');
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByPopularity();
	});  // конец $.post

			//обработчики для разных сортировок(возрастание/убывание по весу/стоимости/популярности)
	//обрабатываем клик по элементу с id=CostUp(если кликнули по сортировке -"увеличение стоимости")
	$('#CostUp').on('click',eventSortByCostUp); //при клике на элемент с id=CostUp будет сробатывать
									//переданная нами ф-ция eventSortByCostUp
	//обрабатываем клик по элементу с id=CostDown(если кликнули по сортировке -"уменьшение стоимости")
	$('#CostDown').click(eventSortByCostDown); //либо $('#CostUp').on('click', eventSortByCostDown);
		// внутри функции будет доступна переменная this - это объект, 
		// соответствующий элементу, по которому кликнули (альтернатива e.target)
	//обрабатываем клик по элементу с id=WeightUp(если кликнули по сортировке -"по увеличению веса")
	$('#WeightUp').click(eventSortByWeightUp);
	//обрабатываем клик по элементу с id=WeidhtDown(если кликнули по сортировке -"по уменьшению веса")
	$('#WeightDown').click(eventSortByWeightDown);
	//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по увелич. популярности")
	$('#PopularityUp').click(eventSortByPopularityUp);
	//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по уменьш. популярности")
	$('#PopularityDown').click(eventSortByPopularityDown);
			//обработчик клика по кнопки поиска
	//.........
	$('#SearchButton').on('click', searchItem);

			//обработка всех кликов по элементам с классом do-action
	$(document).on('click','.do-action[data-action=show_basket]', showBasket); // то есть при клике на
	// элемент с классом do-action и который иимеет атрибут data-action равный show_basket запустится
	// ф-ция showBasket. В этой ф-ции слик будет доступен по this
	$(document).on('click','.do-action[data-action=filter]', filterBy);
	$(document).on('click','.do-action[data-action=put_in_basket]', putInBasket);
	$(document).on('click','.do-action[data-action=show_one_item]', showOneItem);
	$(document).on('click','.do-action[data-action=minus_ItemBasket]', minusItemBasket);
	$(document).on('click','.do-action[data-action=plus_ItemBasket]', plusItemBasket);
	$(document).on('click','.do-action[data-action=del_element_basket]', delElementBasket);
	$(document).on('click','.do-action[data-action=full_goods]', printFullListGoods);

	//добавить обработчик на searchItem

	// $(document).on('click', '.do-action', function(event) { // .on означает все действия(клик, 
	// 	//наведение мышью и тд), далее определяются условия отбора('click', '.do-action') - значит отбирать
	// 	//элементы на которых произошел клик и которые имеют класс do-action
	// 	console.log('this');
	// 	console.log(this);
	// 	var action_click = $(this).attr('data-action');//берем значение атрибута data-action
	// 	console.log('data-action сейчас:' + action_click);
	// 	actions[action_click](this); //берем значение поля объекта(это ссылка на ф-цию) и вызываем ф-цию
	// 								//передаем this - это действие клик	
	// });
}); // конец document.ready

//ф-ция выводит в "каталог" переданный в нее массив
function printCatalogList(gds, catalog) { //получаем массив для "печати" и ссылку "в какой элемент выводить"
	for (var i in gds) {
		printOneElement(gds[i]); //вызываем ф-цию вывода одного элемента
	}
}
//ф-ция выводит в каталог ОДИН элемент массива goods
function printOneElement(el) { //принимает элемент, который нужно вывести
	var div1 = $('<div>',{class: 'testClass'}).appendTo(catalog);//создаем html элемент <div>
	// в {} назначаем все атрибуты и выводимый текст, и сразу вставляем(appendTo) в элемент catalog
	//можно было бы указать appendTo('.catalog') - то есть в элемент с классом catalog
	var div2 = $('<div>',{id: el.idnumber, class: 'catalog__item', 'data-action': 'show_one_item'})
		.appendTo(catalog);//создал div2 и добавил его в catalog
	div2.append($('<span>',{class: 'catalog__item-name do-action', 'data-action': 'show_one_item',
		text: el.name}));//в конец div2 добавил span
	div2.append($('<img>',{class: 'catalog__item-preview do-action', 'data-action': 'show_one_item',
		src: el.image}));
	div2.append($('<span>',{class: 'catalog__item-cost do-action', 'data-action': 'show_one_item',
		text: 'Цена: '+ el.cost + ' руб'}));
	div2.append($('<span>',{class: 'catalog__item-weight do-action', 'data-action': 'show_one_item',
		text: 'Вес: '+ el.weight + ' кг'}));
	div2.append($('<span>',{class: 'catalog__item-popularity do-action', 'data-action': 'show_one_item',
		text: 'Популярность: '+ el.popularity}));
	div1.append(div2);
	div1.append($('<button>',{class: 'catalog__item-button do-action', 'data-action': 'put_in_basket', 
		text:'Положить в корзину'}));
	
}
//ф-ция возвращает ассоц. массив, где ключ - название категории, значение - кол-во товара в категории(кол-во повторений)
function getCatListFromGoods() {
	var cat_mass = [];
	goods.forEach(function(el,i,arr) {
		if (cat_mass[el.category] == undefined)
			cat_mass[el.category] = 1;
		else 
			cat_mass[el.category] ++;
	});
	return cat_mass;
}
//ф-ция выводит в "фильтр по категориям" список по категориям
function fillingFilterByCategory() {
	//получаем ассоц массив(ключ - это название категории товара, значение - кол-во товара в категории)
	cats = getCatListFromGoods();
	for (key_category in cats) {
		var li = $('<li>').appendTo(filter_categories);
		li.append($('<a>', {href: '#', 
			class: 'do-action',		// чтобы в последствии обрабатывать клики на элементы с этим классом
			'data-action': 'filter', //для определения что нужно делать фильтрацию
			'data-type': 'equal', 	 // для определения как фильтровать(equal - равно значению, 
				// less - меньше или равно, more - больше)
			'data-filter': 'category', // для определения по какому полю фильтровать
			'data-value': key_category, // значение по которому сравнивать
			text: key_category}));
		li.append($('<span>',{class: 'badge', text: cats[key_category]}));
	}
}
//ф-ция, заполняющая список по стоимости(больше/меньше 10000) <ul class="filter__cost">
function fillingFilterByCost() {
	var number_lowCost = 0; //для подсчета товаров со стоимостью до 10000
	goods.forEach(function(el,i,arr) {
		if (el.cost <= 10000)
			number_lowCost++;
	});
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_cost);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'less',
				'data-filter': 'cost', 'data-value': '10000', text: 'До 10000'}));
			li.append($('<span>',{class: 'badge', text: number_lowCost}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'more',
				'data-filter': 'cost', 'data-value': '10000', text: 'От 10000'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowCost)}));
		}
	}
}
//ф-ция, заполняющая список по весу (больше/меньше 10 кг) <ul class="filter__weight">
function fillingFilterByWeight() {
	var number_lowWeight = 0; //для подсчета товаров с весом до 10 кг
	for (var i in goods) {
		if (goods[i].weight <= 10)
			number_lowWeight ++;
	}
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_weight);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'less',
				'data-filter': 'weight', 'data-value': '10',	text: 'До 10 кг'}));
			li.append($('<span>',{class: 'badge', text: number_lowWeight}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'more',
				'data-filter': 'weight', 'data-value': '10',	text: 'От 10 кг'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowWeight)}));
		}
	}
}
////ф-ция, заполняющая список по популярности <ul class="filter__popularity">
function fillingFilterByPopularity() {
	var number_lowPopularity = 0; //для подсчета товаров с популярностью до 30
	for (var i in goods) {
		if (goods[i].popularity <= 30)
			number_lowPopularity ++;
	}
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_popularity);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'less',
				'data-filter': 'popularity', 'data-value': '30',	text: 'не популярные(до 30)'}));
			li.append($('<span>',{class: 'badge', text: number_lowPopularity}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'filter', 'data-type': 'more',
				'data-filter': 'popularity', 'data-value': '30',	text: 'популярные(от 30 до 100)'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowPopularity)}));
		}
	}
}
//ф-ция, обрабатывающая клик по элементу с id=CostUp(сортировка по возрастанию цены)
function eventSortByCostUp() {
	catalog.empty();//.innerHTML = ''; //сначала стираем "каталог"
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortCostUp); //сортировка по возраст цены
	printCatalogList(goods, catalog); //выводим уже отсортированный массив товаров
}
//ф-ция, обрабатывающая клик по элементу с id=CostDown(сортировка по убыванию цены)
function eventSortByCostDown() {
	catalog.empty();//.innerHTML = '';
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortCostDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeightUp(сортировка по возрастанию веса)
function eventSortByWeightUp() {
	catalog.empty();//.innerHTML = '';
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortWeightUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeidhtDown(сортировка по убыванию веса)
function eventSortByWeightDown() {
	catalog.empty();//.innerHTML = '';
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortWeightDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityUp(сортировка по возрастанию популярности)
function eventSortByPopularityUp() {
	catalog.empty();//.innerHTML = '';
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortPopularityUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityDown(сортировка по убыванию популярности)
function eventSortByPopularityDown() {
	catalog.empty();//.innerHTML = '';
	class_basket.empty();
	result_search.empty();
	goods = sort(goods, sortPopularityDown);
	printCatalogList(goods, catalog);
}

//ф-ция сортировки - принимает массив и правило сортировки
//метод "пузырька" - нужный элемент "выталкивается" вверх - становиться первым в массиве
function sort(arr,rule) {
	for (var i=0; i < arr.length; i++) {
		for  (var j = i+1; j<arr.length; j++) {
			if (!rule(arr[i],arr[j])) {
				var a = arr[i];
				arr[i] = arr[j];
				arr[j] = a;
			}
		}
	}
	return arr; //возвращает отсортированный массив
}
//праило сортировки по возрастанию цены
function sortCostUp(a,b) {
	return a.cost <= b.cost;//вернет true если a < b , fulse если наоборот
}
//праило сортировки по убыванию цены
function sortCostDown(a,b) {
	return a.cost >= b.cost;
}
//правило сортировки по возрастанию веса
function sortWeightUp(a,b) {
	return a.weight <= b.weight;
}
//правило сортировки по убыванию веса
function sortWeightDown(a,b) {
	return a.weight >= b.weight;
}
//правило сортировки по возрастанию популярности
function sortPopularityUp(a,b) {
	return a.popularity <= b.popularity;
}
//правило сортировки по убыванию популярности
function sortPopularityDown(a,b) {
	return a.popularity >= b.popularity;
}
//ф-ция обрабатывающая фильтрации и выводящая полученный результат в каталог
//(фильтрации по категории, весу(больше/меньше 10кг), популярности(популярные или нет), 
// стоимости(от 10000руб/ до 10000 руб))
function filterBy() {
	var click = this; //this доступен в этой ф-ции(это элемент на который кликнули)
	console.log('мы в ф-ции фильтрации');
    var data_type = $(click).attr('data-type'); // для фильтрации - тип сравнения: больше значения, меньше значения, равно значению
    var data_filter = $(click).attr('data-filter'); // имя поля, по которому фильтруем: цена, вес и т.д.
    var data_value = $(click).attr('data-value'); // конкретное значение, с которым сравниваем. например, имя конкретной категории, товары из которой надо оставить
    var filter_goods; // Промежуточный массив с отфильтрованными товарами
    if (data_type == 'equal') {
    	filter_goods = filterForAll(goods, data_filter, isEqual, data_value);
    } else if (data_type == 'less') {
    	filter_goods = filterForAll(goods, data_filter, isLess, data_value);
    } else if (data_type == 'more') {
    	filter_goods = filterForAll(goods, data_filter, isMore, data_value);
    }
    catalog.empty();
    class_basket.empty();
    result_search.empty();
    printCatalogList(filter_goods, catalog);
}
//ф-ция фильтрации принимает 1)исходный массив, 2)значение data_filter(по какому полю фильтруем: цена, вес,
// категория, популярность), 3)правило фильтрации (больше/меньше/равно значению), 4) значение, с которым
// надо сравнивать
function filterForAll(arr, dfilter, rule, dvalue) {
	var rezult_goods = []; // Промежуточный массив с отфильтрованными товарами
	arr.forEach(function(el) {
		if (rule(el[dfilter], dvalue)) {
			rezult_goods.push(el);
		}
	});
	console.log('отфильтрованный массив ');
	console.log(rezult_goods);
	return rezult_goods;
}

//ф-ция - правило для ф-ции фильтрации(равно значению)
function isEqual(elem, dvalue) {
	return elem == dvalue; 
}
//ф-ция - правило для ф-ции фильтрации(меньше или равно значению)
function isLess(elem, dvalue) {
	return elem <= dvalue; 
}
//ф-ция - правило для ф-ции фильтрации(больше значения)
function isMore(elem, dvalue) {
	return elem > dvalue; 
}

//ф-ция заполняет ассоц.массив товаров для корзины(ключ- имя, значение- объект, поля которого: count- кол-во, 
//cost- цена, weight- вес, idElement- id товара)
//+ выводит общее кол-во товаров в корзине и общую стоимость товаров в корзине + надо сделать общий вес(с помощью
//отдельной ф-ции)
function putInBasket() {
	var click = this;
	console.log('работает action- положить товар в корзину');
	if ($(click).prev().hasClass('catalog__item')) { //если у предыдущего элемента есть класс catalog__item
													// (то есть кликнули из каталога)
		var name = $(click).prev().find('.catalog__item-name').text();//$(click).prev() - взяли у клика 
	//предыдущий сиблинг(можно вместо prev() использовать siblings()). Далее .find('.catalog__item-name')
	// ищем элемент с этим классом. Далее .text() берем контент(то есть получили Имя товара)
		var cost = $(click).prev().find('.catalog__item-cost').text();// получили цену
		var weight = $(click).prev().find('.catalog__item-weight').text(); // получили вес
	}
	if ($(click).parent().hasClass('result_search__item')) { // то есть кликнули из <div class="result_search__item">
		var name = $(click).prev().find('.result_search__item-name').text();
		var cost = $(click).prev().find('.result_search__item-cost').text();// получили цену
		var weight = $(click).prev().find('.result_search__item-weight').text(); // получили вес
	}
	name = name.substr(0,1).toUpperCase() + name.substr(1,name.length).toLowerCase();
	console.log('name товара, который надо положить в корзину: ' + name);
	
	var id = $(click).siblings().attr('id'); //получили id
	var reg_pattern = /\d+/g; // регулярное выражение - ищет число в строке
	if (basket[name] == undefined) 
		basket[name] = {
			count: 1,
			cost: parseInt(cost.match(reg_pattern)),//в строке ищем число(тип будет строковый) и преобразуем в число
			weight: parseInt(weight.match(reg_pattern)),
			idElement: id
		};
	else
		basket[name].count++;
	console.log('массив корзины');
	console.log(basket);
	//считаем и выводим общее кол-во товаров в корзине и общую сумму
	calcSummInfoBasket(click);
}
//ф-ция счетающая общее кол-во товара, общую стоимость товара, общий вес товара в корзине и выводящая эти данные в html
function calcSummInfoBasket(click) {
	console.log('мы в calcSummInfoBasket');
	var totalCost = 0;
	var totalCount = 0;
	var totalWeight = 0; 
	for (key in basket) {
		totalCount+=basket[key].count;
		totalCost += basket[key].count * basket[key].cost;
		totalWeight += basket[key].weight * basket[key].count;
	}
	console.log('общая стоимость: ' + totalCost);
	console.log('общий вес: ' + totalWeight);

	$('#summ_goods').text(totalCount + ' шт. ');//выводим кол-во выбранного товара в "шапку"
	$('#summ_cost').text(totalCost + ' руб '); //выводим общую сумму товаров в "шапку"
	//выводим общий вес и общую сумму когда мы в корзине
	if ($('#sum_weight') != undefined) {
			$('#sum_weight').text('Общий вес: ' + totalWeight);
			$('#sum_cost2').text('Общая стоимость : ' + totalCost);
	}	
	//меняем стоимость товара и его кол-во(если мы в корзине и нажили на +/-)
	if ($(click).parent().prev().attr('data-cost') != undefined) {	//то есть нажали на + или -
		var el_id = $(click).parent().parent().prev().attr('id');
		console.log('el_id: '+el_id);
		for (key in basket) {
			if (basket[key].idElement == el_id) {
				$(click).parent().prev().text('Стоимость: ' + (basket[key].count * basket[key].cost));
				if ($(click).attr('data-action') == 'minus_ItemBasket') {	// если нажали "-"
					console.log('нажали - ');
					$(click).next().text('Кол-во: ' + basket[key].count); //Ноль(0) здесь не получим, так как элемент
					//уже будет удален и так (basket[key].count) мы к нему не обратимся, поэтому 0 в кол-во будем 
					//записывать при удалении
				} else if ($(click).attr('data-action') == 'plus_ItemBasket') {	// если нажали "+"
					console.log('нажали + ');
					$(click).prev().text('Кол-во: ' + basket[key].count);
				}
			}
		}
	}
}
//ф-ция вывода товаров из массива корзины в <div class="basket">
function showBasket() {
	//this здесь доспупен(это элемент на который кликнули)
	console.log('работает action - вывод корзины');
	console.log('this'); console.log(this);
	//удаляем содержимое каталлога(<div class="catalog">) и корзины(<div class="basket">)
	catalog.empty();
	class_basket.empty();
	result_search.empty();
	//выводим в <div class="basket"> товары из массива корзины
	var parent_div = $('<div>',{class: 'full_basket'}).appendTo(class_basket);
	var h1 = $('<h1>',{text: 'КОРЗИНА'}).appendTo(parent_div);
	goods.forEach(function(el,i,arr) {
		for (key in basket) {
			if (basket[key].idElement == el.idnumber ) {
				var div_basket_item = $('<div>',{id: el.idnumber, class: 'basket__item'}).appendTo(parent_div);//создали
				//"родительский" div для элемента корзины и добавили его в parent_div
				$('<div>', { //создаем div не объявляя переменной
					class: 'del_item',
					append: $('<a>', {class: 'do-action', 'data-action': 'del_element_basket', text: 'X'})//сразу добавили в 
					//созданный div тег a
				}).appendTo(div_basket_item);
				$('<div>', {id: el.idnumber, class: 'small_images',
					append: $('<img>', {class: 'do-action','data-action': 'show_one_item', src: el.image})
				}).appendTo(div_basket_item);
				$('<div>', {id: el.idnumber, class: 'left_div',
					append: $('<span>',{class: 'basket__item-name do-action', 'data-action': 'show_one_item', text: 'Название: '+ el.name})
					.add ($('<span>',{class: 'basket__item-description do-action', 'data-action': 'show_one_item', text: 'Описание: '+ el.description}))
					//еще добавили
					.add ($('<span>',{class: 'basket__item-weight do-action', 'data-action': 'show_one_item', text: 'Вес: '+ el.weight + ' кг.'}))
					.add ($('<span>',{class: 'basket__item-popularity do-action', 'data-action': 'show_one_item', text: 'Популярность: ' + el.popularity}))
				}).appendTo(div_basket_item);
				$('<div>', {class: 'right_div',
					append: $('<span>',{class: 'basket__item-cost', text: 'Цена: ' + el.cost +' руб.'})
					.add ($('<span>',{'data-cost': 'change_cost', text: 'Стоимость: ' + basket[key].count*el.cost}))
					.add ($('<div>',{
						append: $('<a>',{href: '#', class: 'do-action', 'data-action': 'minus_ItemBasket', text: '- '})
						.add ($('<span>',{'data-count': 'change_count', text: ' Кол-во: ' + basket[key].count + ' '}))
						.add ($('<a>',{href: '#', class: 'do-action', 'data-action': 'plus_ItemBasket', text: ' +'}))	
						}))
				}).appendTo(div_basket_item);
			}
		}
	});
	$('<div>',{
		append: $('<span>',{id: 'sum_cost2', text: 'Общая стоимость: '})
		.add ($('<span>',{id: 'sum_weight', text: 'Общий вес'}))
	}).appendTo(class_basket);
	//вызов ф-ции для подсчета и вывода общей стоимости и общего веса, токже общего кол-ва товара в корзине
	calcSummInfoBasket(this);	//передаем this, так как в showBasket он доступен
}
//ф-ция удаляет товар из корзины + выводит обновленную инфу по общей стоимости, кол-ву, весе, и стоимости по 
//изменяемому товару(с помощью отдельной ф-ции)
function minusItemBasket() {
	var click = this;
	console.log('надо бы удалить элемент из корзины');
	var id_goods = $(click).parent().parent().prev().attr('id'); //получили id
	console.log(id_goods);
	for (key in basket) {
		if (basket[key].idElement == id_goods) {
			if (basket[key].count > 1) {
				basket[key].count -=1;
				console.log('теперь кол-во товара: ' + basket[key].count);
			} else {
				$(click).parent().prev().text('Стоимость: ' + 0);
				$(click).next().text('Кол-во: ' + 0);
				console.log('надо удалить из корзины элемент: ' + key);
				delete basket[key];
				console.log('массив basket после удаления'); console.log(basket);
			}
		}
	}
	//вызываем ф-цию, считающую и выводящую инфу по полной стоимости, весу, кол-ве
	calcSummInfoBasket(click);
}
////ф-ция добавляет товар в корзину + выводит обновленную инфу по общей стоимости, кол-ву, весе, и стоимости по 
//изменяемому товару(с помощью отдельной ф-ции)
function plusItemBasket() {
	var click = this;
	console.log('мы в plusItemBasket');
	//получить id
	var id_goods = $(click).parent().parent().prev().attr('id');
	console.log('надо обработать: ' + id_goods);
	//в массиве goods найти элемент по id(получить имя и порядковый номер)
	var name_goods;
	var i_goods;
	for (var i in goods) 
		if (goods[i].idnumber == id_goods) {
			console.log('нашли в goods элемент с id: ' + goods[i].idnumber);
			name_goods = goods[i].name;
			i_goods = i;
			console.log('получили имя: ' + name_goods);
			console.log('получили номер элемента: ' + i_goods);
		}
	//проверить, есть ли в массиве корзины элемент с именем name_goods. Если нет, то создать. Если есть count++
	if (basket[name_goods] == undefined) {
		basket[name_goods] = {
			count: 1,
			cost: goods[i_goods].cost,
			weight: goods[i_goods].weight,
			idElement: id_goods
		}
	} else basket[name_goods].count ++;
	//вызываем ф-цию, считающую и выводящую инфу по полной стоимости, весу, кол-ву
	calcSummInfoBasket(click);
}
//при нажатии на X в корзине удаляет этот элемент из массива корзины(и выводим в каталок "новую" корзину)
function delElementBasket() {
	var click = this;
	console.log('удалить элемент из корзины');
	var del_el = $(click).parent().next().attr('id');
	console.log(del_el);
	for (var key in basket) {
		if (basket[key].idElement == del_el)
			delete basket[key];
	}
	console.log(basket);
	showBasket();
}
//ф-ция выводит в каталог полную инфу о товаре на который кликнули(идентификация по всему div-ву)
function showOneItem() {
	var click = this;
	console.log('работает action- показ выбранного товара');
	var id_item = $(click).parent().attr('id');
	console.log(id_item);
	catalog.empty();
	class_basket.empty();
	result_search.empty();
	for (var i in goods) {
		if (goods[i].idnumber == id_item) {
			var div_full_data = $('<div>',{class: 'full-data'}).appendTo(catalog);
			var div_id = $('<div>', {id: id_item, class: 'catalog__item',
					append: $('<span>',{class: 'catalog__item-name', text: goods[i].name})
					.add ($('<span>',{text: goods[i].description}))
					.add ($('<span>',{class: 'catalog__item-weight', text: 'Вес: '+ goods[i].weight+' кг.'}))
					.add ($('<span>',{text: 'Популярность: ' + goods[i].popularity}))
					.add ($('<span>',{class: 'catalog__item-cost', text: 'Цена: ' + goods[i].cost + ' руб.'}))
				});
			div_full_data.append($('<div>',{class: 'flex', append: $('<img>',{src: goods[i].image})}));
			div_full_data.append($('<div>',{class: 'flex', 
									append: div_id
									.add ($('<button>',{class: 'do-action', 'data-action': 'put_in_basket', text: 'Добавить в корзину'}))
								}));
		}
	}
}
//ф-ция запрашивает еще раз массив товаров с сервера и выводит в каталог
function printFullListGoods() {
	console.log('вывести в каталог все товары');
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
		}
		console.log(goods);
		catalog.empty();
		class_basket.empty();
		result_search.empty();
		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);
	});  // конец $.post
}
//ф-ция поиска товаров (будем искать совпадения только по имени и описанию)
function searchItem() {
	console.log('мы в поиске товара');
	var user_input = $('#search').get(0).value;//или $('#search')[0].value; //Тоже что и document.getElementById('search').value
	console.log('что ввели: ' + user_input);

	var reg =  new RegExp(user_input , 'i'); //создаем регулярное выражение вида /наша переменная/i
	console.log('reg'); console.log(user_input);
	//общий массив совпадений
	var search_arr = []; //массив всех совпадений
	goods.forEach(function(el) {
		if (el.description.match(reg) || el.name.match(reg)) {
			var el_search = {};	
			el_search.description = el.description;
			el_search.name = el.name;
			el_search.cost = el.cost;
			el_search.weight = el.weight;
			el_search.popularity = el.popularity;
			el_search.category = el.category;
			el_search.idnumber = el.idnumber;
			el_search.image = el.image;
			el_search.reg = user_input;
			if(el.description.match(reg))
				el_search.fieldDescript = "yes";
			if(el.name.match(reg))
				el_search.fieldName = "yes";
			search_arr.push(el_search);
		}
	});
	console.log('получили общий массив совпадений');
	console.log(search_arr);

	// вызываем ф-цию вывода по поиску
	printResultSearch(search_arr); 
}
//ф-ция выводящая результат поиска
function printResultSearch(arr) {		//принимаем массив совпадений
	//считаем кол-во совпадений по имени и описанию
	var len_name = 0;
	var len_descrip = 0;
	for (var i in arr) {
		if (arr[i].fieldName == "yes"){
			len_name++;
		}
		if (arr[i].fieldDescript == "yes")
			len_descrip++;
	}
	console.log('сейчас выведем результаты поиска');
	catalog.empty();
	class_basket.empty();
	result_search.empty();
	result_search.append($('<h1>', {text: 'Результаты поиска'})
						.add($('<h3>', {text: 'По имени ( '+ len_name +' совпадений:)'})));
	var div_byname = $('<div>', {class: 'result_search__byName flex'}).appendTo(result_search);
	result_search.append($('<h3>', {text: 'По описанию ( ' + len_descrip + ' совпадений:)'}));
	var div_bydescr = $('<div>', {class: 'result_search__bydescr flex'}).appendTo(result_search);

	//вызываем ф-цию вывода элементов массива в соответстующие div-ы(если нашли по имени то в 
	// <div class="result_search__byName flex"> , если по описанию то 
	//в <div class="result_search__byDescription flex">)
	printSearchElements(div_byname, div_bydescr, arr);
}
//
function printSearchElements(parent1, parent2 , arr) {	
	arr.forEach(function(el) {
		var reg = new RegExp(el.reg, 'i');

		var div_item = $('<div>', {class: 'result_search__item',
							append: $('<div>', {id: el.idnumber , class: 'small_images',
							append: $('<img>', {class: 'do-action', 'data-action': 'show_one_item', src: el.image})})
						});
		var span1 = $('<span>', {class: 'result_search__item-name do-action', 'data-action': 'show_one_item'});
		var span2 = $('<span>', {class: 'do-action', 'data-action': 'show_one_item'});
		var div = $('<div>', {id: el.idnumber, class: 'search-info',
						append:span1
						.add(span2)
						.add($('<span>', {class: 'result_search__item-weight do-action', 'data-action': 'show_one_item', text: 'Вес: '+el.weight}))
						.add($('<span>', {class: 'do-action', 'data-action': 'show_one_item', text: 'Популярность: '+el.popularity}))
						.add($('<span>', {class: 'result_search__item-cost do-action', 'data-action': 'show_one_item', text: 'Цена: '+el.cost}))
					}).add($('<button>', {class: 'do-action', 'data-action': 'put_in_basket', text: 'Добавить в корзину'}))
					.appendTo(div_item);
		
		if (el.fieldName == "yes") {
			var new_str =el.name.replace(reg, "<b>"+el.reg.toUpperCase()+"</b>");
			span1.html(new_str);
			span2.text('Описание: ' + el.description);
			var clone_div = div_item.clone(true); //создаем глубокую(со всеми вложенными элементами)
			// копию элемента div_item(иначе при совпадении и в имени и в описании не вывести div_item
			// в два разных div-а)
			parent1.append(clone_div);
		}
		if (el.fieldDescript == "yes") {
			var new_str =el.description.replace(reg, "<b>"+el.reg.toUpperCase()+"</b>");
			span2.html("Описание: " + new_str);
			span1.text(el.name);
			parent2.append(div_item);
		}
	});
}