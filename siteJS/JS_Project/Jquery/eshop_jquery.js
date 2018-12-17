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
	div2.append($('<span>',{class: 'catalog__item-name do-action', text: el.name}));//в конец div2 добавил span
	div2.append($('<img>',{class: 'catalog__item-preview do-action', src: el.image}));
	div2.append($('<span>',{class: 'catalog__item-cost do-action', text: 'Цена: '+ el.cost + ' руб'}));
	div2.append($('<span>',{class: 'catalog__item-weight do-action', text: 'Вес: '+ el.weight + ' кг'}));
	div2.append($('<span>',{class: 'catalog__item-popularity do-action', text: 'Популярность: '+ el.popularity}));
	div1.append(div2);
	div1.append($('<button>',{class: 'catalog__item-button do-action', 'data-action': 'put_in_basket', 
		text:'Положить в корзину'}));
	
}

//ф-ция, обрабатывающая клик по элементу с id=CostUp(сортировка по возрастанию цены)
function eventSortByCostUp() {
	catalog.empty();//.innerHTML = ''; //сначала стираем "каталог"
	goods = sort(goods, sortCostUp); //сортировка по возраст цены
	printCatalogList(goods, catalog); //выводим уже отсортированный массив товаров
}
//ф-ция, обрабатывающая клик по элементу с id=CostDown(сортировка по убыванию цены)
function eventSortByCostDown() {
	catalog.empty();//.innerHTML = '';
	goods = sort(goods, sortCostDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeightUp(сортировка по возрастанию веса)
function eventSortByWeightUp() {
	catalog.empty();//.innerHTML = '';
	goods = sort(goods, sortWeightUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeidhtDown(сортировка по убыванию веса)
function eventSortByWeidhtDown() {
	catalog.empty();//.innerHTML = '';
	goods = sort(goods, sortWeidhtDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityUp(сортировка по возрастанию популярности)
function eventSortByPopularityUp() {
	catalog.empty();//.innerHTML = '';
	goods = sort(goods, sortPopularityUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityDown(сортировка по убыванию популярности)
function eventSortByPopularityDown() {
	catalog.empty();//.innerHTML = '';
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
function sortWeidhtDown(a,b) {
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

//ф-ция возвращает ассоц. массив, где ключ - название категории, значение - кол-во товара в категории(кол-во повторений)
function getCatListFromGoods(gs) {
	var cat_mass = [];
	gs.forEach(function(el,i,arr) {
		if (cat_mass[el.category] == undefined)
			cat_mass[el.category] = 1;
		else 
			cat_mass[el.category] ++;
	});
	return cat_mass;
}
//ф-ция выводит в "фильтр по категориям" переданный в нее массив
function fillingFilterByCategory(arr) {
	for (key_category in arr) {
		var li = $('<li>').appendTo(filter_categories);
		li.append($('<a>',{href: '#',class: 'do-action', 'data-category': key_category, 'data-action': 'print_category', 
			text: key_category}));
		li.append($('<span>',{class: 'badge', text: arr[key_category]}));
	}
}
//ф-ция, заполняющая список по стоимости(больше/меньше 10000) <ul class="filter__cost">
function fillingFilterByCost() {
	var number_lowCost = 0; //для подсчета товаров со стоимостью до 10000
	goods.forEach(function(el,i,arr) {
		if (el.cost < 10000)
			number_lowCost++;
	});
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_cost);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_cost', 'data-price': 'less-10000', 
				text: 'До 10000'}));
			li.append($('<span>',{class: 'badge', text: number_lowCost}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_cost', 'data-price': 'more-10000', 
				text: 'От 10000'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowCost)}));
		}
	}
}
//ф-ция, заполняющая список по весу (больше/меньше 10 кг) <ul class="filter__weight">
function fillingFilterByWeight() {
	var number_lowWeight = 0; //для подсчета товаров с весом до 10 кг
	for (var i in goods) {
		if (goods[i].weight < 10)
			number_lowWeight ++;
	}
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_weight);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_weight', 'data-weight': 'less-10', 
				text: 'До 10 кг'}));
			li.append($('<span>',{class: 'badge', text: number_lowWeight}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_weight', 'data-weight': 'more-10', 
				text: 'От 10 кг'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowWeight)}));
		}
	}
}
////ф-ция, заполняющая список по популярности <ul class="filter__popularity">
function fillingFilterByPopularity() {
	var number_lowPopularity = 0; //для подсчета товаров с популярностью до 9
	for (var i in goods) {
		if (goods[i].popularity < 9)
			number_lowPopularity ++;
	}
	//создаем элементы html
	for (var i=0; i<2; i++) {	
		var li = $('<li>').appendTo(filter_popularity);
		if (i==0) {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_popularity', 'data-popularity': 'less-30', 
				text: 'не популярные(до 30)'}));
			li.append($('<span>',{class: 'badge', text: number_lowPopularity}));
		} else {
			li.append($('<a>',{href: '#',class: 'do-action', 'data-action': 'print_popularity', 'data-popularity': 'more-30', 
				text: 'популярные(от 30 до 100)'}));
			li.append($('<span>',{class: 'badge', text: (goods.length - number_lowPopularity)}));
		}
	}
}

//ф-ция заполняет ассоц.массив товаров для корзины(ключ- имя, значение- объект, поля которого: count- кол-во, 
//cost- цена, weight- вес, idElement- id товара)
//+ выводит общее кол-во товаров в корзине и общую стоимость товаров в корзине + надо сделать общий вес(с помощью
//отдельной ф-ции)
function putInBasket(click) {
	console.log('полученный this');
	console.log(click);
	console.log('работает action- положить товар в корзину')
	var name = $(click).prev().find('.catalog__item-name').text();//$(click).prev() - взяли у клика 
	//предыдущий сиблинг(можно вместо prev() использовать siblings()). Далее .find('.catalog__item-name')
	// ищем элемент с этим классом. Далее .text() берем контент(то есть получили Имя товара)
	console.log(name);
	var cost = $(click).prev().find('.catalog__item-cost').text();// получили цену
	var weight = $(click).prev().find('.catalog__item-weight').text(); // получили вес
	var id = $(click).siblings().attr('id'); //получили id
	var reg_pattern = /\d+/g; // регулярное выражение - ищет число в строке
	if (basket[name] == undefined) //sib_name.innerText вернет текст внутри элемента
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
//ф-ция вывода товаров из корзины в каталог
function showBasket(click) {
	console.log('работает action - вывод корзины');
	//удаляем содержимое каталлога
	catalog.empty();//.innerHTML = '';
	//выводим в каталог товары из корзины
	var parent_div = $('<div>',{class: 'full_basket'}).appendTo(catalog);
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
				$('<div>', {id: el.idnumber, class: 'small_images', 'data-action': 'show_one_item',
					append: $('<img>', {class: 'do-action', src: el.image})
				}).appendTo(div_basket_item);
				$('<div>', {id: el.idnumber, class: 'left_div', 'data-action': 'show_one_item',
					append: $('<span>',{class: 'basket__item-name do-action', text: 'Название: '+ el.name})
					.add ($('<span>',{class: 'basket__item-description do-action', text: 'Описание: '+ el.description}))
					//еще добавили
					.add ($('<span>',{class: 'basket__item-weight do-action', text: 'Вес: '+ el.weight + ' кг.'}))
					.add ($('<span>',{class: 'basket__item-popularity do-action', text: 'Популярность: ' + el.popularity}))
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
	}).appendTo(catalog);
	//вызов ф-ции для подсчета и вывода общей стоимости и общего веса, токже общего кол-ва товара в корзине
	calcSummInfoBasket(click);
}
//ф-ция выводит в каталог полную инфу о товаре на который кликнули(идентификация по всему div-ву)
function showOneItem(click) {
	console.log('работает action- показ выбранного товара');
	var id_item = $(click).parent().attr('id');
	console.log(id_item);
	catalog.empty();
	for (var i in goods) {
		if (goods[i].idnumber == id_item) {
			console.log('jquery id_item: ' + id_item);
			var div_full_data = $('<div>',{class: 'full-data'}).appendTo(catalog);
			var div_id = $('<div>', {id: id_item,
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
//ф-ция выводит в каталог товары выбранной категории
function printCategory(click) {
	console.log('работает action- вывод в каталог выбранной категории товаров');
	//чистим каталог
	catalog.empty();//.innerHTML = '';
	//определяем по какой категории кликнули
	var category = $(click).attr('data-category'); //получили имя категории, по которой кликнули
														//(это значение атрибута data-category)
	//выводим товары по выбранной категории в каталог
	for (var i=0; i<goods.length; i++)
		if (goods[i].category == category)
			printOneElement(goods[i]);			
}
//ф-ция выводит в каталог товары по фильтру больше/меньше 10000
function printCost(click) {
	console.log('работает action- вывод в каталог товаров по стоимости больше/меньше 10000');
	//чистим каталог
	catalog.empty();//.innerHTML = '';
	//определяем по какой категории кликнули
	var cost = $(click).attr('data-price'); //click.attributes.getNamedItem('data-price').value;
	console.log(cost);
	//выводим товары по выбранной категории в каталог
	if (cost == 'less-10000') {
		for (var i=0; i<goods.length; i++)
			if (goods[i].cost < 10000) {
				printOneElement(goods[i]);
			}
	}
	else {
		for (var i=0; i<goods.length; i++)
			if (goods[i].cost >= 10000) {
				printOneElement(goods[i]);
			}
	}		
}
//ф-ция выводит в каталог товары по фильтру больше/меньше 10 кг
function printWeight(click) {
	console.log('работает action- вывод в каталог товаров по весу больше/меньше 10кг');
	catalog.empty();//.innerHTML = '';
	var weight = $(click).attr('data-weight'); //click.attributes.getNamedItem('data-weight').value;
	console.log(weight);
	if (weight == 'less-10') {
		for (var i in goods)
			if (goods[i].weight < 10) {
				printOneElement(goods[i]);
			}
	}
	else {
		for (var i in goods)
			if (goods[i].weight >= 10) {
				printOneElement(goods[i]);
			}
	}
}
////ф-ция выводит в каталог товары по фильтру "популярность до 30 или от 30 до 100"
function printPopularity(click){
	console.log('работает action- вывод в каталог товаров по популярности(до 30 или от 30 до 100)');
	catalog.empty();//.innerHTML = '';
	var popularity = $(click).attr('data-popularity'); //click.attributes.getNamedItem('data-popularity').value;
	console.log(popularity);
	if (popularity == 'less-30') {
		for (var i in goods)
			if (goods[i].popularity < 30) {
				printOneElement(goods[i]);
			}
	}
	else {
		for (var i in goods)
			if (goods[i].popularity >= 30) {
				printOneElement(goods[i]);
			}
	}
}
//ф-ция счетающая общее кол-во товара, общую стоимость товара, общий вес товара в корзине и выводящая эти данные в html
function calcSummInfoBasket(click) {
	console.log('мы в calcSummInfoBasket');
	console.log(click);
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
	//меняем стоимость элемента и его кол-во(если мы в корзине)
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
//ф-ция удаляет товар из корзины + выводит обновленную инфу по общей стоимости, кол-ву, весе, и стоимости по 
//изменяемому товару(с помощью отдельной ф-ции)
function minusItemBasket(click) {
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
function plusItemBasket(click) {
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
	//вызываем ф-цию, считающую и выводящую инфу по полной стоимости, весу, кол-ве
	calcSummInfoBasket(click);
}
//
function printFullListGoods() {
	console.log('вывести в каталог все товары');
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//console.log(goods_test);
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			//goods[i].popularity = Math.round(Math.random()*35);
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
			//goods[i].description = RndText.sentences(4, 3, 9); //уже получаем описание
		}
		console.log(goods);
		catalog.empty();//.innerHTML = '';
		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);
	});  // конец $.post
}
//при нажатии на X в корзине удаляет этот элемент из массива корзины(и выводим в каталок "новую" корзину)
function delElementBasket(click) {
	console.log('удалить элемент из корзины');
	var del_el = $(click).parent().next().attr('id');
	console.log(del_el);
	for (var key in basket) {
		if (basket[key].idElement == del_el)
			delete basket[key];
	}
	console.log(basket);
	showBasket(click);
}
//ф-ция поиска товара(не сделано)
function searchItem() {
	console.log('мы в поиске товара');
	var test2 = document.getElementById('search').value;
	//var test = document.search.value;
	console.log('что ввели: ' + test2);
}

var catalog; //глобально. будет содержать ссылку на элемент <div class="catalog">
var filter_categories; //глобально. будет содержать ссылку на элемент <ul class="filter__categories">
var filter_cost;	//глобально. будет содержать ссылку на элемент <ul class="filter__cost">
var filter_weight; //будет содержать ссылку на элемент <ul class="filter__weight">
var filter_popularity; // будет содержать ссылку на элемент <ul class="filter__popularity">
var cats; //будет содержать названия катигорий товаров и кол-во товара данной категории
var basket = []; // ассоц.массив товаров в корзине. будет содержать ключ-имя товарова, значение - объект с полями:
                 //count- кол-во, cost- цена, weight- вес, idElement- id товара
var actions = { //объект действий при клике на разные ссылки - его поля соответствуют значениям атрибутов data-action
	show_basket: showBasket,	//значение полей это ссылки на ф-ции
	put_in_basket: putInBasket,
	show_one_item: showOneItem,
	print_category: printCategory,
	print_cost: printCost,
	minus_ItemBasket: minusItemBasket,
	plus_ItemBasket: plusItemBasket,
	print_weight: printWeight,
	print_popularity: printPopularity,
	full_goods: printFullListGoods,
	del_element_basket: delElementBasket
	}
var goods; //массив объектов(товаров) - будем получать через AJAX запрос

$(document).ready(function(e){
	catalog = $('.catalog').first();//document.getElementsByClassName('catalog')[0];
	console.log(catalog);
	catalog.empty();//.innerHTML = ''; //очищаем все в <div class="catalog">
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			//goods[i].popularity = Math.round(Math.random()*35);
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
			//goods[i].description = RndText.sentences(4, 3, 9); //из подключенного модуля. генерируем 4 предложения,
											//в каждом случайное кол-во слов(от 3 до 9)
		}
		console.log(goods);

		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);

			//обработка сортировок
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
		$('#WeidhtDown').click(eventSortByWeidhtDown);
		//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по увелич. популярности")
		$('#PopularityUp').click(eventSortByPopularityUp);
		//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по уменьш. популярности")
		$('#PopularityDown').click(eventSortByPopularityDown);
					
					//обработка списка фильтрации по категориям
		//получаем ассоц массив(ключ - это название категории товара, значение - кол-во товара в категории)
		//нужен будет для заполнения <ul class="filter__categories">
		cats =getCatListFromGoods(goods);
		filter_categories = $('.filter__categories').first();//document.getElementsByClassName('filter__categories')[0];
		filter_categories.empty();//.innerHTML = ''; //очищаем все в <ul class="filter__categories">
		//заполняем фильтр по категориям <ul class="filter__categories">
		fillingFilterByCategory(cats);

					//обработка списка фильтрации по стоимости
		filter_cost = $('.filter__cost').first(); //document.getElementsByClassName('filter__cost')[0];
		filter_cost.html(''); // можно использовать вместо .empty()
		//заполняем фильтр по стоимости(больше/меньше 10000) <ul class="filter__cost">
		fillingFilterByCost();

					//обработка списка фильтрации по весу
		filter_weight = $('.filter__weight').first(); //document.getElementsByClassName('filter__weight')[0];
		filter_weight.html('');
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByWeight();

					//обработка списка фильтрации по популярности
		filter_popularity = $('.filter__popularity').first(); //document.getElementsByClassName('filter__popularity')[0];
		filter_popularity.html('');
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByPopularity();
		
	});  // конец $.post
			
				//обработки кликов внутри каталога
	//document.onclick = function(event) {
	$(document).on('click', '.do-action', function(event) { // 'click' - чтобы в ф-ции далее 
		// был доступен клик (this). '.do-action' - будет отрабатываться на клик по элементам, у которых
		// есть класс .do-action
		// Если надо было обрабатывать только кнопки, то можно было написать так
		// $(document).on('click', 'button', function(event) {
		var click1 = event.target; //элемент, на который кликнули
		console.log('click1');
		console.log(click1);
		console.log('this');
		console.log(this);
	
		//var action_parent = click1.parentElement.hasAttribute('data-action');//проверяем есть ли у родителя клика
																	//атрибут data-action(вырнет true или false)
		//var action_element = click1.hasAttribute('data-action');//проверяем есть ли у элемента, на который кликнули
																//атрибут data-action(вырнет true или false)
		//console.log('у родителя есть data-action ?' + action_parent);
		//console.log('у элемента есть data-action ?' + action_element);

		var action_click;
		
		if($(this).data('action') != undefined) { //если у элемента, на который кликнули есть атрибут data-action, то
			action_click = $(this).attr('data-action');//берем значение атрибута data-action
		} else if($(this).parent().data('action') != undefined) {//если у родителя элемента, на который кликнули есть атрибут data-action, то
			action_click = $(this).parent().attr('data-action');//берем значение атрибута data-action
		} else return;
		console.log('data-action сейчас:' + action_click);
		
		actions[action_click](this); //берем значение поля объекта(это ссылка на ф-цию) и вызываем ф-цию
									//передаем this - это действие клик	
	});
	

});	// конец document.ready
