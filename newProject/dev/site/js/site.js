

//объект - ЧЕРЕПАШКА
/*turtle = {
	age: 40,
	live: true
}
turtle.newAge = function() {			//если ф-ция вызвана, то увеличиваем возраст на 1
	if(this.age > 100) this.live = false;
	else this.age++;
}

turtle.getAge = function(){		//получить возраст(какой он на данный момент)
    return this.age;
}
turtle.setAge = function(a){	// задать возраст
    this.age = a;
}
turtle.setAge(60);
console.log(turtle.getAge());
turtle.setAge(99);  //устанавливаем возраст
turtle.newAge();	//увеличиваем на год
turtle.newAge();	//увеличиваем на год
turtle.newAge();	//увеличиваем на год

turtle.isLive = function () {	//возвращает значение жива ли черепаха
	return this.live;
}

console.log("Жива черепаха? " + turtle.isLive());	//обращаемся к методу, чтобы понять жива ли черепаха
console.log("Возраст черепахи:" + turtle.getAge());	
*/




								

;(function(){
    var last_n = 0;
    var main = {
        sum : function(n) {
            var sum = last_n + n;
            last_n = n;
			return sum;
		}
	}
	window.OurMath = main; // или return main;  //создали новый метод у объекта window. Этот метод теперь является
												//ссылкой на объект, полем которого является ф-ция(которая вычесляет
												//сумму поданного числа с предыдущем значением)
})(); // () значат что вызываем на месте
//console.log(OurMath.sum(5)); //вариант обращение - обращаемся к методу(OurMath), который создали,
							 // у которого есть свой метод(поле sum)
//console.log(OurMath.sum(3));





// Делаем модуль для ф-ции, которая на вход получает строку с алгебраическим выражением, на выходе - решение(Калькулятор)
; (function(){
function parseString(fr) {
   if ( !isNaN(fr) ) return +fr; //isNaN возвращает логическое значение, которое указывает, 
   								//является ли значение зарезервированным значением NaN (не числом).
   								//(Метод isNaN пытается преобразовать переданный параметр в число)
   								//то есть проверяем если fr можно преобразовать в число, то возвращаем это число
   var pos = fr.indexOf('+'),
       opd1, opd2;
   if (pos < 0) pos = fr.indexOf('-');
   if (pos < 0) pos = fr.indexOf('*');
   if (pos < 0) pos = fr.indexOf('/');
  
   opd1 = fr.slice(0, pos);
   opd2 = fr.slice(pos + 1);
   var obj = {
       opd1: parseString(opd1),
       opd2: parseString(opd2),
       opn: fr.slice(pos, pos + 1)
   }
   return calculate(obj);
};

function calculate(o) { 
    switch(o.opn) {
        case '+':
            return o.opd1 + o.opd2;
            break;
        case '-':
        	return o.opd1 - o.opd2;
            break;
        case '*':
        	return o.opd1 * o.opd2;
            break;
        default:
        	return o.opd1 / o.opd2;
	}
};

var calc = { //объект
	process: parseString
}

window.c = calc;

})(); 				//конец модуля - Калькулятор

//console.log(c.process('  3-5 +8/2 - 3*    7'));
//console.log(c.process('-10-10'));



// Модуль для ф-ции, на входе которой количество необходимых предложений, на выходе - текст из заданного кол-ва предложений
// Генератор предложений.
; (function() {
const alphabet = 'aeiouyqwrtpsdfghjklzxcvbnm'; //строка алфавита
const vowel_counter = 6;
const consonant_counter = 20;
var generator = function(n) {
	var text =[]; //задали массив для слов
	var len = 10; //начальное условие, чтобы первый раз слово могло быть меньше 3 символов.
	var len_min = 1;
	var len_max = 7;
	for (var i=0; i<n; i++) {
		if (len < 3) {			//чтобы слово получилось от 3-х до 8-и символов
			len_min = 3;
			len_max = 5;
		} else {				//чтобы слово получилось от 1-го до 8-и символов
			len_min = 1;
			len_max = 7;
		}
		len = Math.round(Math.random()*len_max + len_min); //рандомная(от 1 до 8) длина слова, но если слово будет длинной
														//меньше 3-х букв, то длина следующего слова будет(от 3 до 8)
		text.push(getRndWord(len)); //добавляем в конец массива элемент, полученный из getRndWord(), то есть слово
		if (i==0) { // делаем первую букву заглавной
			text[i] = text[0][0].toUpperCase() + text[i].substr(1);
		}
	}
	return text.join(' '); 
}
//ф-ция выдающая гласную букву
var getVowel = function() {
	return alphabet[Math.round(Math.random()*(vowel_counter-1))];
}
//ф-ция выдающая согласную букву
var getConsonant = function() {
	return alphabet[Math.round(Math.random()*(consonant_counter-1) + vowel_counter)];
}
//ф-ция выдает любую букву(гласная/согласная)
var getLetter = function() {
	return alphabet[Math.round(Math.random()*(vowel_counter+consonant_counter-1))]; //или return symbols[Math.round(Math.random()*25)
}
//ф-ция определяет гласная или согласная буква
//на входе буква, на выходе true если гласная и false если согласная
var isVowel = function(symbol) {
	return (alphabet.indexOf(symbol) < vowel_counter); //ищем symbl в строке alphabet, если symble есть в строке,
														  //то возвращается индекс элемента в строке, далее сравниваем
														  //этот индекс с 6(так как дальше согласные)
}
//ф-ция возвращает случайное слово, на входе размер слова(кол-во букв в слове)
var getRndWord = function(n_word) {
	var word = getLetter();//сначала слову присваиваем любую букву
	while(word.length < n_word) {
		if (isVowel(word[word.length-1]))
			word+=getConsonant();
		else
			word+=getVowel();
	}
	return word;
}
//функция, которая генерирует текст, состоящий из нескольких предложений. На входе - нужное кол-во предложений
//В каждом предложении случайное количество слов от 3 до 7.
//Слова разделяются пробелом. Каждое предложение кончается точкой. Первая бкува предложения заглавная.
var getRndSentences = function(n_sentence) {
	var arr_sentences = []; //массив для предложений
	for (var i=0; i<n_sentence; i++) {
		var len = Math.round(Math.random()*4 + 3); //количество слов в предложении от 3 до 7
		arr_sentences[i] = generator(len) + '.'; //генерируем предложение, с добавлением точки в конце
												 // и помещаем полученное в элемент массива
	}
	//addCapLetter(arr_sentences); //делаем первую букву для каждого предложения заглавной
	return arr_sentences.join(' '); //преобразуем массив в строку через разделитель(это делает сам join).
							   		//разделитель передаем мы сами в качестве аргумента в join(это пробел)
}
//ф-ция делает первую букву предложения заглавной. на входе массив, элементы которого предложения
var addCapLetter = function(arr_sent) {
	var len = arr_sent.length;
	for (var i=0 ; i<len ; i++) {
		str = arr_sent[i]; //чтобы далее оперировать с элементами строки 0 и 1(отвязаться от i)
		arr_sent[i] = str[0].toUpperCase() + str.substring(1);//берем первую букву строки через [0], 
		//пропускаем её через toUpperCase, и добавляем к ней оставшуюся часть строки через substring, 
		//передавая в substring параметр 1 (то есть начиная с символа в позиции 1)
	}
}

var RndSent = {
	process: getRndSentences
}
window.RndText = RndSent;//создали интерфейс

})();					//конец модуля - Генератор предложений
//console.log(RndText.process(50));


						// Лекция 9

//Распределение (оператор spread) - оператор распледеление(...)
function test(x1, x2, ...y) {
    console.log(x1);
    console.log(x2);
    console.log(y); //все остальные, сколько бы небыло передано переменных будут объединены в отдельный массив
}
//console.log(test(12, 'ar', 87, 'eret', 'uyueye','fgf', 76));

//обратное распределение (будет преобразование из массива)

						// Лекция 10 (дописываем)

 // Задача							
//В html создать пустой список
//При помощи js заполнить список категориями товаров. Каждая категория должна появиться в списке не более одного раза.
//Исходный список:
//<ul class="catnav__listcat"></ul>
//Пример возможного списка после обработки js
//<ul>
//    <li>Категория 1</li>
//    <li>Категория 2</li> (доп. условие - еще вывести кол-во товара в категории)
//    <li>Категория 3</li>
//    <li>Категория 4</li>
//    <li>Категория 5</li>
//</ul>

//ф-ция - Генератор создание случайного описания
function getDescription() { //пока заглушка
    return "Dgdf dg dfgdfg dfg.";
}
//ф-ция создания нового товара - Генаратор товаров 
function newGood(n) { //создаем объект - инфа по товару 
    return {
        name: 'G' + n,
        category: 'C' + Math.ceil(Math.random() * 5),
        cost: Math.ceil(Math.random() * 20) * 1000,
        description: getDescription(Math.ceil(Math.random() * 5))
    }
}
goods = []; //массив который будет содержать инфу по товарам
for(var i = 0; i < 20; i++) 
	goods.push(newGood(i));  // заполняем массив товаров


var cats; //объявили глобально, будет содержать названия катигорий товаров(далее будет массивом)
var cats2; //объявили глобально, будет содержать названия катигорий товаров и кол-во товара данной категории


document.addEventListener('DOMContentLoaded', function(){ //пока не сформировано ДОМ дерево не делать

var list_c = document.getElementsByClassName('catnav__listcat')[0];
var catalog = document.getElementsByClassName('catalog')[0];

//нужно для каждой найденной категории создать элемент списка(li) и вписать название элементу списка,
// соответствующее категории.
//получим массив, содержащий названия катигорий товаров
cats = getCatListFromGoods(goods); // массив названия категорий
cats.forEach(function(el, i, arr) {		//для каждого элемента массива cats метод forEach исполнит ф-цию(которую пишем мы)
										//, в ф-цию метод передает элемент, его индекс и сам массив
	var li = document.createElement('li'); //создаем элемент <li></li>
	li.innerText = el; // елементу списка добавляем название(то есть вставляем в элемент текст) - <li>название</li>
	list_c.appendChild(li); //в конец родительского элемента list_c(это у нас ul) добавляем li
	});

//написать Другой вариант вывода списка li
//нужно для каждой найденной категории создать элемент списка(li) и вписать название элементу списка и кол-во товара
//cats2 - ассоц. массив (ключи - категории, значения - кол-во товара по категории)
cats2 = getCatListFromGoodsWC(goods); // ассоц. массив (ключи - категории, значения - кол-во товара по категории)
for (key in cats2) {
	var li = document.createElement('li'); //создаем элемент <li></li>
	li.innerText = 'категория : ' + key + ' кол-во товара : ' + cats2[key];
	list_c.appendChild(li);
}
//или так(на лекции)
for (cat_name in cats2) { //cat_name - сами назвали
	var li = document.createElement('li');
	li.innerText = cat_name + ' (' + cats2[cat_name] + ')';
	list_c.appendChild(li);
}

//сделать категории ссылками (и чтоб по ссылке открывались нужные тавары). Кол-во товара по категории в отдельный <span>
// + вставить параметр data, чтобы вышло так: <li data-cat='C1'>C1</li>
//добавить это можно так
//div.setAttribute('data-cat', 'jkhhifj;EFIJe');
//пример что должно получиться
//<li>
//	<a href="#" data-cat='C1'>C1 <span>(10)</span></a>
//</li
for (cat_name in cats2) { 
	var li = document.createElement('li');//создаем элемент <li></li>
	//li.innerHTML = '<a href="#" data-cat='+ cat_name + '>' + cat_name + '<span>(' + cats2[cat_name] + ')</span></a>';
	var a = document.createElement('a');//создаем элемент <a></a>
	a.setAttribute('href', '#');		//ссылке даем атрибут href="#"
	a.setAttribute('data-cat', cat_name); //ссылке даем атрибут data-cat='имя категории'
	var span = document.createElement('span');//создаем элемент <span></span>
	a.innerText = cat_name; // в текст ссылки вставляем 'имя категории'
	span.innerText = ' ('+ cats2[cat_name] +')'; // в текст спана вставляем "кол-во товара"
		//очередность добавления элементов не важна
	list_c.appendChild(li); // добавляем в конец родителя элемент li
	a.appendChild(span); // добавляем в конец a элемент span
	li.appendChild(a); // добавляем в конец li элемент a
}



//внутри <div class="catalog"> для каждого товара создать div и поместить в эти div-ы название тавара и его цену
// (цену и название разнести в разные <span> с разными классами)
goods.forEach(function(el, i, arr) {
	var div = document.createElement('div'); //создаем элемент <div></div>
	// класс для спана catalog__item-name
	var span1 = document.createElement('span'); //создаем переменную, которая будет указывать на первый span
	span1.className = 'catalog__item-name';		//задаем класс - это один вариант задания класса
	span1.innerText = el.name; 	//в первый спан вносим текст - название товара
	// класс для спана catalog__item-price
	var span2 = document.createElement('span'); //создаем переменную, которая будет указывать на второй span
	span2.setAttribute('class', 'catalog__item-price'); //задаем класс - это второй вариант задания класса
	span2.innerText = el.cost;	//во пвторой спан вносим текст - цена товара
	div.appendChild(span1); // добавляем в созданный div первый span
	div.appendChild(span2); // добавляем в созданный div второй span
	catalog.appendChild(div); //в конец родительского элемента(<div class="catalog">) добавляем div
	});


}); //конец document.addEventListener

//ф-ция возвращает массив, содержащий названия встрачающихся категорий товаров. На входе массив товаров(массив объектов)
function getCatListFromGoods(gs) {
	var res = []; //массив категорий
	gs.forEach(function(el, i, arr) { // так как передали массив объектов, то кождый его элемент(el) это объект
									  //и у каждого el есть свои поля(name, category, cost, description)
		//нам нужно заполнить массив категорий, но добавлять в массив только те категории, которые еще не встречались
		if (res.indexOf(el.category) == -1) //если категория еще не встречалась, то добавляем элемент в массив
			res.push(el.category);
	});
	return res;
}
//другой вариант ф-ции. 
//Будет возвращать ассоциативный массив категорий(ключ - категория, значение - кол-во повторений(сколько раз встретилась данная категория))
//То есть на выходе список категорий и количество товара по данной категории.
function getCatListFromGoodsWC(gs) { // с колличеством по каждой категории
	var res = []; //ассоциативный массив категорий(ключ - категория, значение - кол-во повторений)
	gs.forEach(function(el, i, arr) {
		if (res[el.category] == undefined)  //если категория еще не встречалась, то 
			res[el.category] = 1;		//элементу массива с ключем el.category присвоит значение 1(этим мы создаем
										//элемент ассоц. массива с ключем el.category и значением 1)
		else res[el.category]++; //то есть если элемент с ключем el.category есть в массиве(не равен undefined),
									// то увеличить его знаение на +1
	});
	return res;
}



					// Лекция 11

//регулярные выражения 
//https://regex101.com/ - регулярные выражения онлайн(удобно отлаживать выражения)
/*
var regex1 = /\w+/;  // заданное выражение не меняется
var regex2 = new RegExp('\\w+'); //можем вместро строки передавать в регулярку ф-цию
console.log(regex1); 
console.log(regex2);
console.log(regex1 === regex2);
var str = "Что-то случилось"; 
alert( str.search( /-то/i ) ); // ищет только первое совпадение, возвращает индекс(i - регистр не важен) - позицию
*/

//str.match(reg)  // возвращает само выражение
str = 'Ой-ой-ой';
r1 = str.search( /ой/ );
r2 = str.search( /ой/i );
r3 = str.match( /ой/ );
r4 = str.match( /ой/i );
r5 = str.match( /ой/ig );
r6 = str.match( /ой/gi );
//console.log('r1- '+r1+ ' r2- '+ r2+' r3- '+ r3 + ' r4- '+ r4 + ' r5- '+ r5 + ' r6- '+ r6);

//для автоматич проверки кода можно использовать регулярные выражения!!! - перед публикацией удалять consile.log и тд

//Основные метасимволы
//  ^     начало строки
	//если ^ стоит перед каким-то метасимволом, то означает "НЕ" этот символ
//  $     конец строки
//  \A     начало текста
//  \Z     конец текста
//  .     любой символ в строке
//  \w     буквенно-цифровой символ или "_"
//  \W     не \w
//  \d     цифровой символ
//  \D     не \d
//  \s     любой "пробельный" символ (по умолчанию - [ \t\n\r\f])
//  \S     не \s
//  \b     Совпадает на границе слова
//  \B     Совпадает не на границе слова
//  Группировка:
//      ( ыва )
//      Вариации
//      ( x | y )


//Повторение
//  *     ноль или более раз ("жадный"), то же что {0,}
//  +   один или более раз ("жадный"), то же что {1,}
//  ?   ноль или один раз ("жадный"), то же что {0,1}
//  {n}   точно n раз ("жадный")
//  {n,}   не менее n раз ("жадный")
//  {n,m} не менее n но не более m раз ("жадный")
//  *?     ноль или более раз ("не жадный"), то же что {0,}?
//  +?     один или более раз ("не жадный"), то же что {1,}?
//  ??     ноль или один раз ("не жадный"), то же что {0,1}?
//  {n}?   точно n раз ("не жадный")
//  {n,}? не менее n раз ("не жадный")
//  {n,m}? не менее n но не более m раз ("не жадный")

//Жадные и ленивые квантификаторы
//В жадном режиме (по умолчанию) регэксп повторяет квантификатор настолько много раз, насколько это возможно, 
//чтобы найти соответствие.
//Ленивый режим - ? после квантификатора.
//var str = "Ой-ой 'ой' ой-ой 'ой' ой-ой";
//console.log( str.match(/'.+'/g) ); //ищет максимальное совпадение (жадный режим)
//console.log( str.match(/'.+?'/g) ); //ищет первое попавшееся совпадение

/*
//найти все что в скобках
var str5 = '11+( 12 * 34 )-56';
console.log(str5.match(/\(.+?\)/gi));  //экранировали скобки \( и \) . Знак вопроса - перевели в ленивый режим
//иначе если были бы еще скобки, то нашел бы выражение от 1-ой скобки до последней собки

//       ^\( - значит любой символ кроме скобки


//вытащить два числа вокруг * и сам знак *, то есть 12 и 34 (более конкретное выражение, но результат тот же,
//так как всего одна скобка)
//      /\(\D*(\d+)\s*([+\-/*])\s*(\d+).*\)/
console.log(str5.match(/\(\D*(\d+)\s*([+-/*])\s*(\d+).*\)/g));

//В заданной строке найти для всех выражений в скобках операнды и операторы.
str4 = '11 + ( 23 + 45 ) + (7 -   876) + ( 23 * 45 ) + ( 23 / 45 )';
var pattern = /\(\D*(\d+)\s*([+-/*])\s*(\d+)\s*\)/g;
console.log(str4.match(pattern));
*/


			//дописываем