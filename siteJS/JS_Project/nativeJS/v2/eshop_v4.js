
//сделать по аналогии с eshop.js !!!!! - далее перевести на jquery

//ф-ция выводит в "каталог" переданный в нее массив
function printCatalogList(gds, catalog) { //получаем массив для "печати" и ссылку "в какой элемент выводить"(пока не нужно)
	for (var i in gds) {
		printOneElement(gds[i]); //вызываем ф-цию вывода одного элемента
	}
}
//ф-ция выводит в каталог ОДИН элемент массива goods
function printOneElement(el) { //принимает элемент, который нужно вывести
	var div1 = document.createElement('div');
	var div2 = document.createElement('div');
	var span1 = document.createElement('span');
	var span2 = document.createElement('span');
	var span3 = document.createElement('span');
	var span4 = document.createElement('span');
	var button = document.createElement('button');
	var img = document.createElement('img');
	span1.className = 'catalog__item-name'; //назначаем класс элементу(назначаем атрибут class=catalog__item-name)
	span2.className = 'catalog__item-cost';
	span3.className = 'catalog__item-weight';
	span4.className = 'catalog__item-popularity';
	img.className = 'catalog__item-preview';
	button.className = 'catalog__item-button';
	button.setAttribute('data-action', 'put_in_basket');
	div2.className = 'catalog__item';
	div2.id = el.idnumber;
	div2.setAttribute('data-action', 'show_one_item');
	span1.innerText = el.name;
	span2.innerText = 'Цена: ' + el.cost + ' руб';
	span3.innerText = 'Вес: ' + el.weight + ' кг';
	span4.innerText = 'Популярность: ' + el.popularity;
	button.innerText = 'Положить в корзину';
	img.src = el.image;	//назначаем атрибут src
	div2.appendChild(span1);
	div2.appendChild(img);
	div2.appendChild(span2);
	div2.appendChild(span3);
	div2.appendChild(span4);
	div1.appendChild(div2);
	div1.appendChild(button);
	catalog.appendChild(div1);
}

//ф-ция, обрабатывающая клик по элементу с id=CostUp(сортировка по возрастанию цены)
function eventSortByCostUp() {
	catalog.innerHTML = ''; //сначала стираем "каталог"
	goods = sort(goods, sortCostUp); //сортировка по возраст цены
	printCatalogList(goods, catalog); //выводим уже отсортированный массив товаров
}
//ф-ция, обрабатывающая клик по элементу с id=CostDown(сортировка по убыванию цены)
function eventSortByCostDown() {
	catalog.innerHTML = '';
	goods = sort(goods, sortCostDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeightUp(сортировка по возрастанию веса)
function eventSortByWeightUp() {
	catalog.innerHTML = '';
	goods = sort(goods, sortWeightUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=WeidhtDown(сортировка по убыванию веса)
function eventSortByWeidhtDown() {
	catalog.innerHTML = '';
	goods = sort(goods, sortWeidhtDown);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityUp(сортировка по возрастанию популярности)
function eventSortByPopularityUp() {
	catalog.innerHTML = '';
	goods = sort(goods, sortPopularityUp);
	printCatalogList(goods, catalog);
}
//ф-ция, обрабатывающая клик по элементу с id=PopularityDown(сортировка по убыванию популярности)
function eventSortByPopularityDown() {
	catalog.innerHTML = '';
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
		var li = document.createElement('li');
		var a = document.createElement('a');
		var span = document.createElement('span');
		span.setAttribute('class', 'badge');
		a.setAttribute('href', '#');
		a.setAttribute('data-category', key_category);
		a.setAttribute('data-action', 'print_category');
		a.innerText = key_category;
		span.innerText = arr[key_category];
		li.appendChild(a);
		li.appendChild(span);
		filter_categories.appendChild(li);
	}
}
//ф-ция, заполняющая список по стоимости(больше/меньше 10000) <ul class="filter__cost">
function fillingFilterByCost() {
	var number_lowCost = 0; //для подсчета товаров со стоимостью до 10000
	var number_hightCost = 0; //для подсчета товаров со стоимостью от 10000
	goods.forEach(function(el,i,arr) {
		if (el.cost < 10000)
			number_lowCost++;
		else
			number_hightCost++;
	});
	//создаем элементы html
	for(var i=0; i<2 ; i++) { //так как всего два <li>
		var li = document.createElement('li');
		var a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('data-action', 'print_cost');
		var span = document.createElement('span');
		span.setAttribute('class', 'badge');
		if (i==0) {
			a.setAttribute('data-price', 'less-10000');
			a.innerText = ' До 10000 ';
			span.innerText = number_lowCost;
		} else {
			a.setAttribute('data-price', 'more-10000');
			a.innerText = ' От 10000 ';
			span.innerText = number_hightCost;
		}
		li.appendChild(a);
		li.appendChild(span);
		filter_cost.appendChild(li);
	}
}
//ф-ция, заполняющая список по весу (больше/меньше 10 кг) <ul class="filter__weight">
function fillingFilterByWeight() {
	var number_lowWeight = 0; //для подсчета товаров с весом до 10 кг
	var number_hightWeight = 0; //для подсчета товаров с весом от 10 кг
	for (var i in goods) {
		if (goods[i].weight < 10)
			number_lowWeight ++;
		else number_hightWeight ++;
	}
	//создаем элементы html
	for(var i=0; i<2 ; i++) { //так как всего два <li>
		var li = document.createElement('li');
		var a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('data-action', 'print_weight');
		var span = document.createElement('span');
		span.setAttribute('class', 'badge');
		if (i==0) {
			a.setAttribute('data-weight', 'less-10');
			a.innerText = ' До 10 кг ';
			span.innerText = number_lowWeight;
		} else {
			a.setAttribute('data-weight', 'more-10');
			a.innerText = ' От 10 кг ';
			span.innerText = number_hightWeight;
		}
		li.appendChild(a);
		li.appendChild(span);
		filter_weight.appendChild(li);
	}
}
////ф-ция, заполняющая список по популярности <ul class="filter__popularity">
function fillingFilterByPopularity() {
	var number_lowPopularity = 0; //для подсчета товаров с популярностью до 9
	var number_hightPopularity = 0; //для подсчета товаров с популярностью от 9
	for (var i in goods) {
		if (goods[i].popularity < 9)
			number_lowPopularity ++;
		else number_hightPopularity ++;
	}
	//создаем элементы html
	for(var i=0; i<2 ; i++) { //так как всего два <li>
		var li = document.createElement('li');
		var a = document.createElement('a');
		a.setAttribute('href', '#');
		a.setAttribute('data-action', 'print_popularity');
		var span = document.createElement('span');
		span.setAttribute('class', 'badge');
		if (i==0) {
			a.setAttribute('data-popularity', 'less-9');
			a.innerText = 'не популярные(от 0 до 9) ';
			span.innerText = number_lowPopularity;
		} else {
			a.setAttribute('data-popularity', 'more-9');
			a.innerText = 'популярные(от 9 до 35) ';
			span.innerText = number_hightPopularity;
		}
		li.appendChild(a);
		li.appendChild(span);
		filter_popularity.appendChild(li);
	}
}

//ф-ция заполняет ассоц.массив товаров для корзины(ключ- имя, значение- объект, поля которого: count- кол-во, 
//cost- цена, weight- вес, idElement- id товара)
//+ выводит общее кол-во товаров в корзине и общую стоимость товаров в корзине + надо сделать общий вес(с помощью
//отдельной ф-ции)
function putInBasket() {
	console.log('работает action- положить товар в корзину')
	var sibling = click.previousSibling;//получаем предыдущего сиблинга(это div)
	var sib_name = sibling.getElementsByClassName('catalog__item-name')[0];//элемент span, содержащий в innerText имя
	var sib_cost = sibling.getElementsByClassName('catalog__item-cost')[0];//элемент span, содержащий в innerText цену
	var sib_weight = sibling.getElementsByClassName('catalog__item-weight')[0];//элемент span, содержащий в innerText вес
	var sib_id = sibling.getAttribute('id');
	//console.log('sib_id '+ sib_id);
	//var sibling_click_id = click.previousSibling.getAttribute('id');//берем id предыдущего сиблинга
	//console.log(sibling_click_id);
	var reg_pattern = /\d+/g; // регулярное выражение - ищет число в строке
	if (basket[sib_name.innerText] == undefined) //sib_name.innerText вернет текст внутри элемента
		basket[sib_name.innerText] = {
			count: 1,
			cost: parseInt(sib_cost.innerText.match(reg_pattern)),//в строке ищем число(тип будет строковый) и преобразуем в число
			weight: parseInt(sib_weight.innerText.match(reg_pattern)),
			idElement: sib_id
		};
	else
		basket[sib_name.innerText].count++;
	console.log('массив корзины');
	console.log(basket);
	//считаем и выводим общее кол-во товаров в корзине и общую сумму
	calcSummInfoBasket();
}
//ф-ция вывода товаров из корзины в каталог
function showBasket() {
	console.log('работает action - вывод корзины');
	//удаляем содержимое каталлога
	catalog.innerHTML = '';
	//выводим в каталог товары из корзины
	var div_parent = document.createElement('div');
	div_parent.className = 'full_basket';
	var h1 = document.createElement('h1');
	h1.innerText = 'КОРЗИНА';
	div_parent.appendChild(h1);
	console.log(basket);
	goods.forEach(function(el,i,arr) {
		for (key in basket) {
			//console.log('попали в for (key in basket)');
			//console.log(basket[key].idElement);
			if (basket[key].idElement == el.idnumber) {
					//console.log('в if - значит сработало basket[key].idElement == el.idnumber');
					//console.log(basket[key].idElement);
					var div1 = document.createElement('div');
					var div_img = document.createElement('div');
					var div_del = document.createElement('div');
					var div2 = document.createElement('div');
					var div3 = document.createElement('div');
					var img = document.createElement('img');
					var span1 = document.createElement('span');
					var span2 = document.createElement('span');
					var span3 = document.createElement('span');
					var span4 = document.createElement('span');
					var span5 = document.createElement('span');
					var span6 = document.createElement('span');
					var del_span = document.createElement('span');
					var cols_div = document.createElement('div');
					var cols_span = document.createElement('span');
					img.src = el.image;
					var a1 = document.createElement('a');
					var a2 = document.createElement('a');
					a1.href = '#';
					a2.href = '#';
					a1.setAttribute('data-action', 'minus_ItemBasket');
					a2.setAttribute('data-action', 'plus_ItemBasket');
					span1.className = 'basket__item-name'; 
					span2.className = 'basket__item-cost';
					span3.className = 'basket__item-weight';
					span4.className = 'basket__item-popularity';
					span5.className = 'basket__item-description';
					span6.setAttribute('data-cost', 'change_cost');
					del_span.setAttribute('data-action', 'del_element_basket');
					cols_span.setAttribute('data-count', 'change_count');
					div1.className = 'basket__item';
					div1.id = el.idnumber; //на всякий случай
					div_del.className = 'del_elem';
					div_img.className = 'small_images';
					div_img.id = el.idnumber; //чтобы при клике на картинку брался id
					div_img.setAttribute('data-action', 'show_one_item');
					div2.id = el.idnumber; //чтобы при клике на описание брался id
					div2.className = 'left_div';
					div2.setAttribute('data-action', 'show_one_item');
					div3.className = 'right_div';
					del_span.innerText = 'X';
					span1.innerText = 'Название: ' + el.name;
					span2.innerText = 'Цена: ' + el.cost + ' руб. ';
					span3.innerText = ' Вес: ' + el.weight + ' кг. ';
					span4.innerText = ' Популярность: ' + el.popularity + ' ';
					span5.innerText = 'Описание товара: ' + el.description;
					span6.innerText = 'Стоимость: ' + basket[key].count*el.cost;
					a1.innerText = ' - ';
					a2.innerText = ' + ';
					cols_span.innerText = ' Кол-во: '+ basket[key].count + ' ';
					div_del.appendChild(del_span);
					cols_div.appendChild(a1);
					cols_div.appendChild(cols_span);
					cols_div.appendChild(a2);
					div_img.appendChild(img);
					div2.appendChild(span1);
					div2.appendChild(span5);
					div3.appendChild(span2);
					div3.appendChild(span6);
					div2.appendChild(span3);
					div2.appendChild(span4);
					div3.appendChild(cols_div);
					div1.appendChild(div_del);
					div1.appendChild(div_img)
					div1.appendChild(div2);
					div1.appendChild(div3);
					div_parent.appendChild(div1);		
			}
		}
	});
	catalog.appendChild(div_parent);
	var div_summInfo = document.createElement('div');
	var span1_info = document.createElement('span');
	var span2_info = document.createElement('span');
	span1_info.id = 'sum_cost2';
	span2_info.id = 'sum_weight';
	span1_info.innerText = 'Общая стоимость: ';
	span2_info.innerText = 'Общий вес: ';
	div_summInfo.appendChild(span1_info);
	div_summInfo.appendChild(span2_info);
	catalog.appendChild(div_summInfo);
	//вызов ф-ции для подсчета и вывода общей стоимости и общего веса, токже общего кол-ва товара в корзине
	calcSummInfoBasket();
}
//ф-ция выводит в каталог полную инфу о товаре на который кликнули(идентификация по всему div-ву)
function showOneItem() {
	console.log('работает action- показ выбранного товара');
	//console.log(click.parentElement.attributes.getNamedItem('id').value);
	var id_item = click.parentElement.attributes.getNamedItem('id').value;//берем у родителя значение атрибута id
	console.log(id_item);
	catalog.innerHTML = '';
	for (i in goods) {
		if (goods[i].idnumber == id_item) {
			var div1 = document.createElement('div');
			var div2 = document.createElement('div');
			var div3 = document.createElement('div');
			var div4 = document.createElement('div');
			var img = document.createElement('img');
			var span1 = document.createElement('span');
			var span2 = document.createElement('span');
			var span3 = document.createElement('span');
			var span4 = document.createElement('span');
			var span5 = document.createElement('span');
			var button = document.createElement('button');
			div1.setAttribute('class', 'full-data');
			button.setAttribute('data-action', 'put_in_basket');
			div4.setAttribute('id', id_item);
			div2.setAttribute('class', 'flex');
			div3.setAttribute('class', 'flex');
			img.src = goods[i].image;
			span1.className = 'catalog__item-name';
			span3.className = 'catalog__item-weight';
			span5.className = 'catalog__item-cost';
			span1.innerText = goods[i].name;
			span2.innerText = 'Описание: ' + goods[i].description;
			span3.innerText = 'Вес: ' + goods[i].weight;
			span4.innerText = 'Популярность: ' + goods[i].popularity;
			span5.innerText = 'Цена: ' + goods[i].cost;
			button.innerText = 'Добавить в корзину';
			div2.appendChild(img);
			div4.appendChild(span1);
			div4.appendChild(span2);
			div4.appendChild(span3);
			div4.appendChild(span4);
			div4.appendChild(span5);
			div3.appendChild(div4);
			div3.appendChild(button);
			div1.appendChild(div2);
			div1.appendChild(div3);
			catalog.appendChild(div1);
		}
	}
}
//ф-ция выводит в каталог товары выбранной категории
function printCategory() {
	console.log('работает action- вывод в каталог выбранной категории товаров');
	//чистим каталог
	catalog.innerHTML = '';
	//определяем по какой категории кликнули
	var goods_category = click.attributes.getNamedItem('data-category').value;
	//выводим товары по выбранной категории в каталог
	for (var i=0; i<goods.length; i++)
		if (goods[i].category == goods_category)
			printOneElement(goods[i]);			
}
//ф-ция выводит в каталог товары по фильтру больше/меньше 10000
function printCost() {
	console.log('работает action- вывод в каталог товаров по стоимости больше/меньше 10000');
	//чистим каталог
	catalog.innerHTML = '';
	//определяем по какой категории кликнули
	var goods_cost = click.attributes.getNamedItem('data-price').value;
	console.log(goods_cost);
	//выводим товары по выбранной категории в каталог
	if (goods_cost == 'less-10000') {
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
function printWeight() {
	console.log('работает action- вывод в каталог товаров по весу больше/меньше 10кг');
	catalog.innerHTML = '';
	var data_weight = click.attributes.getNamedItem('data-weight').value;
	console.log(data_weight);
	if (data_weight == 'less-10') {
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
////ф-ция выводит в каталог товары по фильтру "популярность от 0 до 9 или от 9 до 35"
function printPopularity(){
	console.log('работает action- вывод в каталог товаров по популярности(от 0 до 9 или от 9 до 35)');
	catalog.innerHTML = '';
	var data_popularity = click.attributes.getNamedItem('data-popularity').value;
	console.log(data_popularity);
	if (data_popularity == 'less-9') {
		for (var i in goods)
			if (goods[i].popularity < 9) {
				printOneElement(goods[i]);
			}
	}
	else {
		for (var i in goods)
			if (goods[i].popularity >= 9) {
				printOneElement(goods[i]);
			}
	}
}
//ф-ция счетающая общее кол-во товара, общую стоимость товара, общий вес товара в корзине и выводящая эти данные в html
function calcSummInfoBasket() {
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

	document.getElementById('summ_goods').innerText = totalCount + ' шт. '; //выводим кол-во выбранного товара в "шапку"
	document.getElementById('summ_cost').innerText = totalCost + ' руб '; //выводим общую сумму товаров в "шапку"
	
	//выводим общий вес и общую сумму когда мы в корзине
	if (document.getElementById('sum_weight') != undefined) {
		document.getElementById('sum_weight').innerText = 'Общий вес: ' + totalWeight;
		document.getElementById('sum_cost2').innerText = 'Общая стоимость : ' + totalCost;
	}
	//меняем стоимость элемента и его кол-во(если мы в корзине)
	for (key in basket) {
		if (click.parentElement.previousElementSibling.hasAttribute('data-cost')) {//то есть нажали на + или -
			var el_id = click.parentElement.parentElement.previousSibling.attributes.getNamedItem('id').value;
			console.log('el_id: ' + el_id);
			if (basket[key].idElement == el_id) {
				console.log('id совпали');
				//var name_test = key
				click.parentElement.previousSibling.innerText = 'Стоимость: ' + (basket[key].count * basket[key].cost);
				if (click.nextElementSibling != undefined) {//если нажали на -
					click.nextSibling.innerText = 'Кол-во: ' + basket[key].count;//Ноль(0) здесь не получим, так как элемент
				//уже будет удален и так (basket[key].count) мы к нему не обратимся, поэтому 0 в кол-во будем 
				//записывать при удалении
				} else if (click.previousElementSibling != undefined) //если нажали на +
					click.previousSibling.innerText = 'Кол-во: ' + basket[key].count;
			}	
		}
	}
}
//ф-ция удаляет товар из корзины + выводит обновленную инфу по общей стоимости, кол-ву, весе, и стоимости по 
//изменяемому товару(с помощью отдельной ф-ции)
function minusItemBasket() {
	console.log('надо бы удалить элемент из корзины');
	var id_goods = click.parentElement.parentElement.previousSibling.attributes.getNamedItem('id').value;
	console.log(id_goods);
	for (key in basket) {
		if (basket[key].idElement == id_goods) {
			if (basket[key].count > 1) {
				basket[key].count -=1;
				console.log('теперь кол-во товара: ' + basket[key].count);
				//test.innerText = 'Стоимость: ' + ;
			} else {
				click.parentElement.previousSibling.innerText = 'Стоимость: ' + 0;
				click.nextSibling.innerText = 'Кол-во: ' + 0;
				console.log('надо удалить из корзины элемент: ' + key);
				delete basket[key];
				console.log('массив basket после удаления'); console.log(basket);
			}
		}
	}
	//вызываем ф-цию, считающую и выводящую инфу по полной стоимости, весу, кол-ве
	calcSummInfoBasket();
}
////ф-ция добавляет товар в корзину + выводит обновленную инфу по общей стоимости, кол-ву, весе, и стоимости по 
//изменяемому товару(с помощью отдельной ф-ции)
function plusItemBasket() {
	console.log('мы в plusItemBasket');
	//получить id
	var id_goods = click.parentElement.parentElement.previousSibling.attributes.getNamedItem('id').value;
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
	calcSummInfoBasket();
}
//
function printFullGoods() {
	console.log('вывести в каталог все товары');
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//console.log(goods_test);
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			goods[i].popularity = Math.round(Math.random()*35);
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
			goods[i].description = RndText.sentences(4, 3, 9);
		}
		console.log(goods);
		catalog.innerHTML = '';
		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);
		console.log('проверка массива goods после перезапроса');
		console.log('формируем массив категорий cats из вновь полученного массива goods');
		var cats2 = getCatListFromGoods(goods);
		console.log(cats2);
		console.log('вывод старого(первоначального) массива категорий');
		console.log(cats);
	});  // конец $.post
}
//при нажатии на X в корзине удаляет этот элемент из массива корзины(и выводим в каталок "новую" корзину)
function delElementBasket() {
	console.log('удалить элемент из корзины');
	var del_el = click.parentElement.nextSibling.attributes.getNamedItem('id').value;
	console.log(del_el);
	for (var key in basket) {
		if (basket[key].idElement == del_el)
			delete basket[key];
	}
	console.log(basket);
	showBasket();
}
//ф-ция поиска товара
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
var click; //будет содержать элемент, на который кликнули
var action_click; // будет содержать значение атрибута data-action
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
	full_goods: printFullGoods,
	del_element_basket: delElementBasket
	}
//var goods_test;
var goods; //массив объектов(товаров) - будем получать через AJAX запрос

document.addEventListener('DOMContentLoaded', function(e){
	//clearCotegoryListHTML(); // очистить список по категориям в html
	//clearCostListHTML();	 // очистить список по стоимости(<10000 , >10000) в html
	//clearCatalogListHTML();	 // очистить каталог товаров в html //будем использовать другой метод очистки(см. ниже)
	catalog = document.getElementsByClassName('catalog')[0];
	catalog.innerHTML = ''; //очищаем все в <div class="catalog">
	$.post('http://r2ls.ru/', {seed:1}, function(data){ // AJAX запрос
		goods = JSON.parse(data); //преобразуем в массив обектов и помещаем в переменную goods
		//console.log(goods_test);
		//преобразуем массив к используемому мной
		for (var i=0; i<goods.length; i++) {
			goods[i].popularity = Math.round(Math.random()*35);
			goods[i].image = 'images/'+(i+1)+'.svg';
			goods[i].idnumber = 'id'+i;
			goods[i].description = RndText.sentences(4, 3, 9); //из подключенного модуля. генерируем 4 предложения,
											//в каждом случайное кол-во слов(от 3 до 9)
		}
		console.log(goods);

		//вывести все имеющиеся товары(первоначальное состояние страницы) в каталог (<div class="catalog">)
		printCatalogList(goods, catalog);

			//обработка сортировок
		//обрабатываем клик по элементу с id=CostUp(если кликнули по сортировке -"увеличение стоимости")
		document.getElementById('CostUp').onclick = eventSortByCostUp;
		//обрабатываем клик по элементу с id=CostDown(если кликнули по сортировке -"уменьшение стоимости")
		document.getElementById('CostDown').onclick = eventSortByCostDown;
		//обрабатываем клик по элементу с id=WeightUp(если кликнули по сортировке -"по увеличению веса")
		document.getElementById('WeightUp').onclick = eventSortByWeightUp;
		//обрабатываем клик по элементу с id=WeidhtDown(если кликнули по сортировке -"по уменьшению веса")
		document.getElementById('WeidhtDown').onclick = eventSortByWeidhtDown;
		//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по увелич. популярности")
		document.getElementById('PopularityUp').onclick = eventSortByPopularityUp;
		//обрабатываем клик по элементу с id=PopularityUp(если кликнули по сортировке -"по уменьш. популярности")
		document.getElementById('PopularityDown').onclick = eventSortByPopularityDown;
					
					//обработка списка фильтрации по категориям
		//получаем ассоц массив(ключ - это название категории товара, значение - кол-во товара в категории)
		//нужен будет для заполнения <ul class="filter__categories">
		cats =getCatListFromGoods(goods);
		filter_categories = document.getElementsByClassName('filter__categories')[0];
		filter_categories.innerHTML = ''; //очищаем все в <ul class="filter__categories">
		//заполняем фильтр по категориям <ul class="filter__categories">
		fillingFilterByCategory(cats);

					//обработка списка фильтрации по стоимости
		filter_cost = document.getElementsByClassName('filter__cost')[0];
		filter_cost.innerHTML = '';
		//заполняем фильтр по стоимости(больше/меньше 10000) <ul class="filter__cost">
		fillingFilterByCost();

					//обработка списка фильтрации по весу
		filter_weight = document.getElementsByClassName('filter__weight')[0];
		filter_weight.innerHTML = '';
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByWeight();

					//обработка списка фильтрации по популярности
		filter_popularity = document.getElementsByClassName('filter__popularity')[0];
		filter_popularity.innerHTML = '';
		//заполняем фильтр по весу <ul class="filter__weight">
		fillingFilterByPopularity();
		
	});  // конец $.post
			
				//обработки кликов внутри каталога
	document.onclick = function(event) {
		click = event.target; //элемент, на который кликнули
		console.log(click);
	
		var action_parent = click.parentElement.hasAttribute('data-action');//проверяем есть ли у родителя клика
																	//атрибут data-action(вырнет true или false)
		var action_element = click.hasAttribute('data-action');//проверяем есть ли у элемента, на который кликнули
																//атрибут data-action(вырнет true или false)
		console.log('у родителя есть data-action ?' + action_parent);
		console.log('у элемента есть data-action ?' + action_element);
		
		if(action_element) { //если у элемента, на который кликнули есть атрибут data-action, то
			action_click = click.attributes.getNamedItem('data-action').value;//берем значение атрибута data-action
		} else if(action_parent) {//если у родителя элемента, на который кликнули есть атрибут data-action, то
			action_click = click.parentElement.attributes.getNamedItem('data-action').value;//берем значение атрибута data-action
		} else return;

		console.log('data-action сейчас:' + action_click);
		
		actions[action_click](); //берем значение поля объекта(это ссылка на ф-цию) и вызываем ф-цию	
	}
	

});	// конец document.addEventListener
