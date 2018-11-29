												//level 1

//Задача 1
//Написать программу, которая запрашивает у пользователя число 
//(через вызов функции prompt()), умножает его на 2 и выводит результат в консоль.
/*
var new_num = function(number) {
	return number*=2;
}
console.log(new_num(prompt('введите число')));
*/

//Задача 2
//Написать программу, которая запрашивает у пользователя 2 числа 
//(через 2 вызова функции prompt()), складывает их и выводит результат в консоль.
/*
var a = prompt('введите первое число');
var b = prompt('введите второе число');
var fun = function(num1, num2) {
	return (parseInt(num1) + parseInt(num2));
}
console.log(fun(a,b));
*/

//Задача 3
//Написать программу, которая спрашивает у пользователя число, 
//находит среднее арифметическое(average) чисел от 1 до введенного пользователем и выводит результат в консоль.
//(Среднее арифметическое - число, равное сумме всех чисел множества, деленное на их количество)
/*
var user_number = prompt('введите число'); // user_name получается строка
var average = function (number) {
	sum = 0;
	for (let i=1; i <= number ; i++) {  //фактически i преобразуется в строку и сравнивается с user_number?
		sum+=i;
	}
	return sum/number;  //??? при этом number преобразуется в чмсо?
}
console.log(average(user_number));
*/

//Задача 4
//Написать программу, которая предлагает пользователю на выбор два действия: сложение и вычитание.
//Для выбора сложения пользователь должен ввести “1”, для выбора вычитания - “2”.
//Затем программа запрашивает у пользователя два числа, выполняет над ними выбранную операцию
// и выводит результат вместе с описанием выбранного пользователем действия в консоль.
/*
var what_you_want = parseInt(prompt('для выполнения сложения введите 1, для вычетания - 2'));
while (what_you_want != 1 & what_you_want != 2) { //пока значение не 1 и не 2 выводим запрос
	what_you_want = parseInt(prompt('для выполнения сложения введите 1, для вычетания - 2'));
}
//console.log('выбрано: ' + what_you_want);
var number1 = parseInt(prompt('введите первое число'));
var number2 = parseInt(prompt('введите второе число'));
var rezalt = '';
var action = function(num1,num2) {
	if (what_you_want == 1) {
		rezalt = 'результат сложения: ';
		//console.log(rezalt);
		return num1 + num2;
	} else {								//не проверяем на условие =2, так как из цикла while 
											//условие выхода или 1 или 2
		rezalt = 'результат вычетания: ';
		return num1 - num2;
		}
 }
console.log('операция над числами: ' + number1 + ' и ' + number2);
//console.log(action(number1,number2) + ' - это ' + rezalt);
var rez = action(number1,number2);
console.log(rezalt + rez);
*/

//Задача 5
//Написать программу, которая по выбору пользователя осуществляет следующие операции 
//(с указанным количеством параметров):
//-	сложение (два параметра);
//-	вычитание (два параметра);
//-	умножение (два параметра);
//-	деление (два параметра);
//-	среднее арифметическое от 1 до N (один параметр)/
//Результат выполнения выводится в консоль.
/*
var addition = function(a,b) { // сложение
	return a+b;
}
var subtraction = function(a,b) { // вычитание
	return a-b;
}
var multiplication = function(a,b) { //умножение
	return a*b;
}
var division = function(a,b) { //деление
	return a/b;
}
var average = function(n) { // среднее арифметическое
	var rez = 0;
	for (var i=1 ; i <= n ; i++) {
		rez += i;
	}
	return rez/n;
}

var what_you_want = parseInt(prompt('сложение - 1, вычитания -2, умножение - 3, деление - 4, среднее арифм. - 5'));
//while (what_you_want < 1 & what_you_want > 5) { //пока не выбрали от 1 до 5 выводить запрос
//	what_you_want = parseInt(prompt('сложение - 1, вычитания -2, умножение - 3, деление - 4, среднее арифм. - 5'));
//}
//или
//while (!(what_you_want >= 1 & what_you_want <= 5)) { //проскакивать мимо будет только тогда, когда значение 
 													  //между 1 и 5 включительно. всё остальное будет 
 													  //внутрь цикла заводить, NaN тоже
//	what_you_want = parseInt(prompt('сложение - 1, вычитания -2, умножение - 3, деление - 4, среднее арифм. - 5'));
//}
//или
while ([1,2,3,4,5].indexOf(what_you_want) == -1) { //то есть пока выбор не будет 1,2,3,4 или 5, то предлагать ввод
	what_you_want = parseInt(prompt('сложение - 1, вычитания -2, умножение - 3, деление - 4, среднее арифм. - 5'));
}

var number = '';
var number1 = '';
var number2 = '';
if (what_you_want == 5) {
	number = parseInt(prompt('введите число: '));
} else {
	number1 = parseInt(prompt('Введите первое число: '));
	number2 = parseInt(prompt('Введите второе число: '));
}

switch (what_you_want) {
	case 1:
		//message = 'результат сложения: ';
		console.log('результат сложения: '+number1+' + '+number2+' = ' + addition(number1,number2));
		break;
	case 2:
		console.log('результат вычитания: '+number1+' - '+number2+' = ' + subtraction(number1,number2));
		break;
		//message = 'результат вычитания: ';
		//return subtraction(number1,number2);
	case 3:
		console.log('результат умножения: '+number1+' * '+number2+' = ' + multiplication(number1,number2));
		break;
		//message = 'результат умножения: ';
		//return multiplication(number1,number2);
	case 4:
		console.log('результат деления: '+number1+' / '+number2+' = ' + division(number1,number2));
		break;
		//message = 'результат деления: ';
		//return division(number1,number2);
	default:
		console.log('среднее арифметическое от 1 до '+number+' : ' + average(number));
		//message = 'среднее арифметическое: ';
		//return average(number);
}
*/

//Задача 8
//Написать функцию, которая принимает неограниченное количество аргументов и возвращает их сумму.
function calcSumm(...x) {
	summ = 0;
	//var len = x.length;
	//for (var i=0; i<len; i++)
	//	summ = summ + x[i];
	//или
	x.forEach(function(el,i,arr) {
		summ = summ + el;
	});
	return summ;
}
//console.log(calcSumm(2, 4, -20, 8, 0, 20));

//Задача 10
//Написать функцию, которая принимает строку, а возвращает ее в нижнем регистре с первой буквой в верхнем регистре.
//Пример правильного решения для строки “sd KJH j HKky iug” - “Sd kjh j hkky iug”
function upperFirstStr(str) {
	var new_str = '';
	//str.forEach(function(el,i,arr) {
	//	if (i==0)
	//		new_str += arr[i].toUpperCase();
	//	else
	//		new_str += arr[i].toLowerCase();
	//});
	var len = str.length;
	for(i=0;i<len;i++) {
		if (i==0)
			new_str += str[i].toUpperCase();
		else
			new_str += str[i].toLowerCase();
	}
	return new_str;
}
//console.log(upperFirstStr('sd KJH j HKky iug'));

//Комплексные задачи
//Задача 17
//Напишите программу, которая добавляет в пустую страницу элемент “div”.
//Задача 18
//Напишите программу, которая в элемент “div” из предыдущего примера добавляет элемент “span” 
//с одним произвольным словом и 4 кнопки “button” с произвольными словами.
document.addEventListener('DOMContentLoaded',function(e) {
	var parent =document.getElementsByTagName('body')[0];
	console.log(parent);
	var div = document.createElement('div');
	var span = document.createElement('span');
	var button1 = document.createElement('button');
	var button2 = document.createElement('button');
	var button3 = document.createElement('button');
	var button4 = document.createElement('button');
	var example = getExample();//см. ниже следующую задачу
	span.innerText = example; //см. ниже следующую задачу
	button1.innerText = 'нажимай1';
	button2.innerText = 'нажимай2';
	button3.innerText = 'нажимай3';
	button4.innerText = 'нажимай4';
	parent.prepend(div);
	div.appendChild(span);
	div.appendChild(button1);
	div.appendChild(button2);
	div.appendChild(button3);
	div.appendChild(button4);
});

//Задача 19
//Напишите программу, которая генерирует случайный пример на сложение двух целых чисел
// и выводит его на страницу (в любой html-элемент, можно, даже, сразу в body).
function getExample() {
	var a = Math.round(Math.random()*100);
	var b = Math.round(Math.random()*100);
	var str = a + ' + ' + b + ' = ?';
	return str;
}
//Задача 20
//Напишите программу, которая для предыдущего примера генерирует 4 разных варианта ответов
// (один из них должен быть верный) и выводит их в виде кнопок под вопросом/задачей.
function getAnswers(str) {
	var opd1=0;
	var opd2=0;
	//тело
	return arr; //возвращаем массив из 4-х элементов(варианты ответа)
}



									// Livel 2

//Задача 1
//Написать генератор случайных слов от 3 до 5 букв (размер - случайное число), 
//где нельзя, чтобы подряд шли две согласные или две гласные буквы (т.е. гласные и согласные должны чередоваться).
//При это, гласность/согласность первой буквы является случайным значением. Слова должны быть разделены пробелом.
//На вход функция принимает один параметр - количество генерируемых слов.
//На выходе функция возвращает сгенерированный текст.
/*
//алфавит
const alphabet = 'aeiouyqwrtpsdfghjklzxcvbnm'; //строка алфавита
const vowel_counter = 6;
const consonant_counter = 20;
//ф-ция генерирует заданное кол-во случайных слов(в каждом слове от 3 до 5 букв)
//на входе - кол-во слов, которое надо сгенерировать. на выходе - текст
var generator = function(n) {
	//var text = '';
	//for (var i=0; i < n ; i++) { // цикл от 1 до нужного кол-ва слов
	//	var len = Math.round(Math.random()*2 + 3); //рандомная(от 3 до 5) длина слова
	//	text += getRndWord(len); //добавляем в строку полученное слово
	//	text += ' '; //добавляем пробел(к последнему тоже добавиться!)
	//}
	//return text;
	//или так
	var text =[]; //задали массив для слов
	for (var i=0; i<n; i++) {
		var len = Math.round(Math.random()*2 + 3); //рандомная(от 3 до 5) длина слова
		text.push(getRndWord(len)); //добавляем в конец массива элемент, полученный из getRndWord(), то есть слово
	}
	return text.join(' '); //преобразуем массив в строку через разделитель(это делает сам join).
							//разделитель передаем мы сами в качестве аргумента в join(это пробел)
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
	//var rnd = Math.round(Math.random()*25);//или вместо 25 написать (alhhabet.length - 1)
	//return alphabet[rnd];
	//или проще
	return alphabet[Math.round(Math.random()*(vowel_counter+consonant_counter-1))]; //или return symbols[Math.round(Math.random()*25)
}
//ф-ция определяет гласная или согласная буква
//на входе буква, на выходе true если гласная и false если согласная
var isVowel = function(symbol) {
	//for (var i=0; i < vowel_counter; i++) {
	//	if (alphabet[i] == symbol) return true;
	//}
	//return false;
	//или проще
	return (alphabet.indexOf(symbol) < vowel_counter); //ищем symbl в строке alphabet, если symble есть в строке,
														  //то возвращается индекс элемента в строке, далее сравниваем
														  //этот индекс с 6(так как дальше согласные)
}
//ф-ция возвращает случайное слово, на входе размер слова(кол-во букв в слове)
var getRndWord = function(n_word) {
	var word = getLetter();//сначала слову присваиваем любую букву
	//for (var i=0; i < n_word-1 ; i++) { //от 0 до (n_word-1) так как слову уже присвоена первая буква
	//	if (isVowel(word[i])) {	//проверяем-буква была гласная?
	//		word += getConsonant(); //если гласная то в слово добавляем согласную
	//	} else {					//если была согласная, то добавляем гласную
	//		word += getVowel();
	//	}
	//}
	//или так
	while(word.length < n_word) {
		if (isVowel(word[word.length-1]))
			word+=getConsonant();
		else
			word+=getVowel();
	}
	return word;
}

//console.log(alphabet[4]);
//console.log(isVowel('h'));
//console.log(gatLetter());
//console.log(getConsonant());
//console.log(getVowel());
//console.log(getRndWord(5));
//getRndWord(5);
console.log(generator(6));
*/

//Задача 2
//			Общая задача
//Реализовать функцию, которая генерирует текст, состоящий из нескольких предложений. Предложения разделяются пробелом.
//В каждом предложении случайное количество слов от 3 до 7. Слова разделяются пробелом. Каждое слово имеет 
//случайную длину от 1 до 8 символов. В слове не должны встречаться подряд 2 гласные или 2 согласные буквы.
//На вход функция принимает один параметр - количество предложений, которое надо сгенерировать.
//Функция возвращает сгенерированный текст.
//			Дополнительное условие
//Каждое предложение должно начинаться с заглавной буквы и заканчиваться точкой.
//			Задание повышенной сложности
//Нельзя, чтобы в одном предложении два соседних слова имели длину менее 3 символов. 
//Соседними словами считаются слова, между которыми только пробел.
/*
//алфавит
const alphabet = 'aeiouyqwrtpsdfghjklzxcvbnm'; //строка алфавита
const vowel_counter = 6;
const consonant_counter = 20;
//ф-ция генерирует заданное кол-во случайных слов(в каждом слове от 1 до 8 букв), то есть генерирует "одно предложение""
//на входе - кол-во слов, которое надо сгенерировать. на выходе - текст(одно предложение)
//Здесь же будем учитывать условие - Нельзя, чтобы в одном предложении два соседних слова имели длину менее 3 символов.
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
			
			//Делаем 1-ую букву предложения заглавной(иначе см. ф-цию addCapLetter, вызываем ее в getRndSentences)
			//мысль - так как text двумерный массив(слова и буквы), то при i=0 делать для первой буквы toUpperCase()
		if (i==0) {
			//или с помощью replace
			//text[i] = text[i].replace(text[i][0], text[i][0].toUpperCase()); //Replace заменяет первое вхождение 
									//в строку искомого символа (первый аргумент) на заменяющий (второй аргумент)
			//или с помощью склеивания(substr)
			text[i] = text[0][0].toUpperCase() + text[i].substr(1);//склеиваем первую букву строки(делая ее заглавной)
																//с оставшейся строкой(начиная с позиции в строке 1)
			//console.log(text[i]);
		}
	}
	
	//вызываем ф-цию проверяющую условие -нельзя чтобы в одном предложении два соседних слова имели длину менее 3 символов
	//var new_text = arrCheck(text); //не использую эту ф-цию
	return text.join(' '); //преобразуем массив в строку через разделитель(это делает сам join).
							//разделитель передаем мы сами в качестве аргумента в join(это пробел)
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
//ф-ция делает первую букву предложения заглавной. на входе массив, элементы которого предложения.
//не использую ее - делаем заглавную букву прямо в генераторе предложения
var addCapLetter = function(arr_sent) {
	var len = arr_sent.length;
	for (var i=0 ; i<len ; i++) {
		str = arr_sent[i]; //чтобы далее оперировать с элементами строки 0 и 1(отвязаться от i)
		arr_sent[i] = str[0].toUpperCase() + str.substring(1);//берем первую букву строки через [0], 
		//пропускаем её через toUpperCase, и добавляем к ней оставшуюся часть строки через substring, 
		//передавая в substring параметр 1 (то есть начиная с символа в позиции 1). Можно вместо substring писать subst
	}
}
//ф-ция проверяет массив строк(одно предложение). Ф-ция выполняет проверку условия - "Нельзя, чтобы 
//в одном предложении два соседних слова не имели длину менее 3 символов" и формирует массив строк под это условие
//То есть проверяем длину строки и если она меньше трех, то длину следующей строке генерируем от 3-х до 8-и слов
//(то есть перезаписываем строку, следующую за строкой, у которой длина меньше 3-х)
// Пойдем другим путем - эту ф-цию использовать не будем. Проверять условие будем прямо в ф-ции генератора предложения.
//var arrCheck = function(arr) {
//	var n = arr.length;
//	for (var i=0; i<n ; i++) {
//		var nlen = arr[i].length;
//		if ( nlen<3 ) {
//			arr[i+1]=getRndWord(Math.round(Math.random()*5 + 3)); //длина слова от 3 до 8
//			i=i+2;
//		}
//	}
//	return arr;
//}

//console.log(alphabet[4]);
//console.log(isVowel('h'));
//console.log(gatLetter());
//console.log(getConsonant());
//console.log(getVowel());
//console.log(getRndWord(5));
//getRndWord(5);
//console.log(generator(6));
//console.log(getRndSentences(5));
//console.log("мама мыла раму".firstLetterCaps(0));
//getRndSentences(1);
console.log(getRndSentences(5));
//var my_arr = ['qwertas','sd','cv','sw','trtrscc','fd','fadadyawkd'];
//var new_arr = arrCheck(my_arr);
//console.log(new_arr);
*/


//Задача 3 (брать вариант, сделанный на уроке)
//Написать функцию, которая выполняет операции сложения, вычитания, умножения и деления над двумя числами.
//На вход функция принимает текстовую строку с выражением. На выходе функция возвращает результат вычисления.
//Текстовая строка на входе может содержать только следующие символы (в любом количестве):
// - цифры;
// - знаки операций +, -, *, /;
// - знак пробела.
//Примеры выражений на входе функции:
//  2 + 2
//  3-1
//  4*      6
//  6                   /                      3
/*
var str = prompt('введите выражение для вычисления:');
var len = str.length;
//console.log('данные: " '+ str + ' "');
//console.log('длина строки:' + len);

var arr_data = [];
var action = '';
var num1 = 0;
var num2 = 0;

var del_space = function(space) { // удаляем пробелы
	var j=0;
	for (i in space) {
		//console.log(i + '  элемент строки: ' + str[i]);
		if (space[i] !=' ') {
			arr_data[j] = space[i];
			j++;
		} 
	}
	return arr_data; //можно не возвращать, так как объявлен глобально
}
del_space(str);
//console.log(arr_data);

//var arr_final = [];
var all_parametrs = function(arr) { // определяем операцию(сложение, деление и тд) и числа(num1, num2)
	for (i in arr) {
		if (['+','-','*','/'].indexOf(arr[i]) != -1) {
			action = arr[i];
		}
	}
	num1 = parseInt(arr[0]); ///а если не целое
	num2 = parseInt(arr[2]);
}

all_parametrs(arr_data);

var addition = function(a,b) { // сложение
	return a+b;
}
var subtraction = function(a,b) { // вычитание
	return a-b;
}
var multiplication = function(a,b) { //умножение
	return a*b;
}
var division = function(a,b) { //деление
	return a/b;
}

switch (action) {
	case '+':
		console.log('результат сложения: '+num1+' + '+num2+' = ' + addition(num1,num2));
		break;
	case '-':
		console.log('результат вычитания: '+num1+' - '+num2+' = ' + subtraction(num1,num2));
		break;
	case '*':
		console.log('результат умножения: '+num1+' * '+num2+' = ' + multiplication(num1,num2));
		break;
	default: // деление
		console.log('результат деления: '+num1+' / '+num2+' = ' + division(num1,num2));
		
}
*/