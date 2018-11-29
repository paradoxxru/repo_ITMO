//console.log('fdyafwdtyfu');
//console.log(goods);
$(document).ready(function() { // ждем формир ДОМ дерева
	//вывод списока товаров в html(только имя товара)
		//найти элемент список(ul)
		/*
		var ul = $('#list');
		//для каждого товара из goods выполнить действие
		goods.forEach(function(el) {
			//создать элемент li
			//var li = $('<li>' + el.name + '</li>');
			//добавить внутрь название
			//li.text(el.name); //уже сделали выше
			//добавить новый элемент в элемент-список
			//ul.append(li);
			//или сразу так
			ul.append('<li>' + el.name + '</li>');
		});
		*/
		//или через отдельную ф-цию
		//printGoodsList($('#list'));	

	//получить список категорий со счетчиком товара из списка товаров goods и вывести в html
	//cats = getCatListFromGoodsWC(goods);
		//создаем новый ассоц массив(пустой) -у него будет ключ - название категория, значение - кол-во товара
		var arr = [];
		//для каждого товара выполняем
		goods.forEach(function(el) {
			//есть ли уже категория в новом массиве
			if (arr[el.category] == undefined){
				//нет - создаем новый элемент ассоц массива(название категории это ключ, значение = 1)
				arr[el.category] = 1;
			} else {
				//да есть, то - кол-во товара увеличиваем(увеличиваем счетчик)
				arr[el.category]++;
			}
		});
		//находим элемент-список
		var ul = $('#list');
		//для каждой категории выполняем действие
		for (arr_category in arr) {
			//создаем новый html элемент и выводим на экран
				// <li> Категория <span> Кол-во товара </span> </li>
				ul.append('<li>' + arr_category + '<span> Кол-во ' + arr[arr_category] + '</span></li>');
		}

});

var cats;

//вывод списока товаров в html(только имя товара)
function printGoodsList(ul) {
	//для каждого товара из goods выполнить действие
	goods.forEach(function(el) {
		//создать элемент li
		//var li = $('<li>' + el.name + '</li>');
		//добавить внутрь название
		//li.text(el.name); //уже сделали выше
		//добавить новый элемент в элемент-список
		//ul.append(li);
		//или сразу так
		ul.append('<li>' + el.name + '</li>');
	});
}

//получить список категорий со счетчиком товара из списка товаров goods
function getCatListFromGoodsWC(gs) {
	var cat_mass = [];
	gs.forEach(function(el,i,arr) {
		if (cat_mass[el.category] == undefined)
			cat_mass[el.category] = 1;
		else 
			cat_mass[el.category] ++;
	});
	return cat_mass;
}
