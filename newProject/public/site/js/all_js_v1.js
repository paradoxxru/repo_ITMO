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
console.log(upperFirstStr('sd KJH j HKky iug'));


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
/*var name = prompt("введите должность");
if (name == "admin") {
	console.log("admin");
} else if (name == "root") {
	console.log("admin");
} else {
	console.log(name);
}*/

/*x=0;
while (x<10) {
	x++;
	console.log(x);
}*/

/*var summ = 0; 
for (var i = 0; i < 5; i++) {
     summ = summ + i;
 	 console.log("i=" + i); 
 	 console.log("summ=" + summ);
}*/

/*b = "Hello";
for(a in b) {
	console.log("b[" + a + "] = " + b[a]);
}*/

/*var x = [1,3,'bbb']; 
x[0]; // 1     
x[1]; // 3 
x[2]; // ”bbb” 
x[5]=60;
console.log(x);*/


/*var y=[]; //объявим пустой  массив 
y['age'] = 20; 
y['city'] = 'St­Petersburg';
y['date'] = '4.3.2018'
y['story'] = 'about.....'
console.log(y);*/

								/*ДЗ 1*/
/*спросить имя и вывести все четные символы имени на экран*/
/*var name = prompt("укажите ваше имя:");
var i_max = name.length;
for (i=0; i<i_max; i++) {
	if (i%2 != 0) {			//так как элементы массива начинаются с 0
		console.log(name[i])
	}
	else {
		continue;
	}
}*/
								/*дз 1 на лекции*/
/*var user_name = prompt("введите ваше имя:");
var user_name_len = user_name.length;
/*for (let i=0; i<user_name_len; i++) {
	if (i % 2 == 1)
		console.log(user_name[i]);
}
for (let i=1; i<user_name_len; i+=2) {	//i+=2 это i=i+2
		console.log(user_name[i]);
}*/

/*запросить число у пользователя и вывести сумму всех четных чисел от 1 до введенного пользователем*/
/*var user_number = prompt("введите число:");
var summ=0;
for (let i=2; i<=user_number; i+=2) {
	summ=summ+i;
}
console.log(summ);*/

/*запросить число у пользователя и вывести количество чисел кратных трем от 1 до числа пользователя*/
/*var user_number = prompt("введите число:");
var col_number=0;
for (let i=3; i<=user_number; i+=3) {
	col_number++;
}
console.log(col_number);*/

/*есть массив - найти мин и макс значения в массиве*/
/*var arr = [2,3,-5,13,5,55,20];
var arr_len = arr.length;
var arr_min = arr[0];
var arr_max =arr[0];
for (let i=0; i < arr_len; i++) {
	if (arr_min > arr[i])
		arr_min = arr[i];
	if (arr_max < arr[i])
		arr_max = arr[i];
}
console.log("(" + arr_min + ";" + arr_max + ")");*/

/* тоже самое с тернарным оператором 
- (условие) ? (значение1-если условие истина) : (значение2 - если условие ложно)*/
/*var arr = [2,3,-5,13,5,55,20];
var arr_len = arr.length;
var arr_min = arr[0];
var arr_max =arr[0];
for (let i=0; i < arr_len; i++) {
		arr_min = arr_min > arr[i]
			? arr[i]
			: arr_min;
		arr_max = arr_max < arr[i]
			? arr[i]
			: arr_max;
}
console.log("(" + arr_min + ";" + arr_max + ")");*/

					/*Функция*/
/*function add(x,y) {
	var total = x + y;
	return total;
}
console.log(add(1,2));
console.log(add(1,2,3)); //сработает, просто третье значение игнорируется
console.log(add(1,"b")); */

/* функция возвращающат минимальное значение элемента массива(одномерного)*/
/*function getMin(arr) {
	let arr_len = arr.length;
	let arr_min = arr[0];
	for (let i=0; i < arr_len; i++) {
		arr_min = arr_min > arr[i]
			? arr[i]
			: arr_min;
	}
	return arr_min;
}
var m = getMin([2,3,5,13,5,55,20]);
console.log(m);
m = getMin([-4,-2,-9,1,-56,-3]);
console.log(m);*/

/* функция возвращающат максимальное значение элемента массива(одномерного)*/
/*function getMax(arr) {
	let arr_len = arr.length;
	let arr_max = arr[0];
	for (i=0 ; i < arr_len ; i++) {
		arr_max = arr_max < arr[i]
			? arr[i]
			: arr_max;
	}
	return arr_max;
}
var n = getMax([1,-3,26,96,32,-7])
console.log(n);
n = getMax([0,0,0,0,7,-5,0,10004]);
console.log(n);*/



/*console.log(“1”)
document.write("......")*/

/*var y; //объявили переменную без типа
console.log(typeof(y));
y=1000;
console.log(typeof(y));
y=0.02;
console.log(typeof(y));
y="Hello";
console.log(typeof(y));
y=console.log(typeof(y)); //выводим тип типа
y=[]; //объявили пустой массив
y["key"]="value";
console.log(typeof(y));
y=[1,2,3];
console.log(typeof(y));*/

/*var a=0,b=0;	//гловальные переменные
function t() {
	a++;		//обращаемся к глобальной переменной
	var b=5;	//переменная внутри функции(с тем же именем, но не видна вне функции)
	b++;
	console.log(b);
	{

	}
}
t();
console.log(a);
console.log(b);*/

/*var a=0,b=0;	//глобальные переменные
function t() {
	a++;		//обращаемся к глобальной переменной
	{var b=5;}	//внутренний блок - 3-й уровень видимости(но если объявлено через var, то видим в функции)
	b++;		//обращаемся к локальной
	console.log("b2=" + b);
	{

	}
}
t();t();t();
console.log("a=" + a);
console.log("b1=" + b);*/

/*var a=0,b=0;	//гловальные переменные
function t() {
	a++;		//обращаемся к глобальной переменной
	{let b=5;}	//внутренний блок - 3-й уровень видимости(снаружи блока(т.е в функции b=5 уже не видна))
	b++;		//обращаемся к глобальной
	console.log("b2=" + b);
	{

	}
}
t();t();t();
console.log("a=" + a);
console.log("b1=" + b);*/

/*console.log(a + "," + b); //выдаст ошибку, так как b далее определена как let
var a=0;
let b=1;
console.log(a + "," + b);
var a=2;
let b=3; // нельзя переопределять let*/

/* исследование двумерного массива*/
/*var arr1 = new Array(); //объявляем пустой массив
var arr2 = new Array(); //объявляем пустой массив
var arr3 = new Array(); //объявляем пустой массив
arr1 = [1,3,5,7,9];			//заполняем массив 1
arr2 = [2,4,6,8,10];		//заполняем массив 2
arr3 = ['a','b','c','d'];	//заполняем массив 3
//console.log(arr1);
//console.log(arr2);
//console.log(arr3);
var arr_2d = new Array(arr1,arr2,arr3); //объявляем двумерный массив и заполняем его одномерными
console.log(arr_2d[1][1]); //вывод элемента вдумерного массива
//перебор двумерного массива(вывод всех значений)
for (let i=0 ; i < arr_2d.length ; i++) {
	for (let j=0 ; j < arr_2d[i].length ; j++) {
		console.log('элемент 2-х мерного массива: позиция i: '+ i + ' позиция j: '+ j + ' значение элемента: ' + arr_2d[i][j]);
	}
}*/

					/*занятие 3*/

/*все аргументы*/
/* функция возвращает сумму всех элементов, переданных в функцию */
//попробовать передать массив(или один массив и еще несколько элементов) и дописать функцию, 
//чтобы считала аугументы массива(tupeoff()-для проверки переданных значений, 
//можно вызвать этуже функцию в этой функции)
/*function add() {
	let sum = 0;
	let len = arguments.length; 
	//console.log(len);			//проверка длины
	console.log(arguments);			// проверка
	for (let i = 0 ; i < len ; i++) {
		sum +=arguments[i];
		//console.log(arguments[i]);	//проверка аргументов
	}
	return sum;
}
var result = add(2,4,6,-5,10,2);
console.log(result);*/

									/*ОБЪЕКТЫ*/

/*var obj = {				//объявление объекта и определение его св-в
     name: "сarrot",
     color: "orange", 
}
//доступ к св-вам
console.log(obj.color);
console.log(obj["color"]); //либо так
console.log(obj.name);
console.log(obj["name"]);  //либо так */

/*двумерный объект*/
/*var obj = {
     name: "сarrot",
     details: {
         color: "orange",
         size: 12,
         age: 0.5
     } 
} 
//доступ к св-вам
console.log(obj.details.color); 
console.log(obj["details"]["size"]) */

/* задание методов*/
/*a = {};
a.customFunction = function() {
console.log('Наш метод!');
}

//Обращение к свойствам объекта
a = {age: 18};
a.getAge = function() {
return this.age;
}
a.getAge();
*/

/*var obj = {				//объявление объекта и определение его св-в
     name: "сarrot",
     color: "orange", 
     i: "www"
}
for(var i in obj){
      console.log(i);
      console.log(obj[i]); 
	  console.log(obj.i); // интересно //обращение именно к полю i !!!
}*/

//Глобальный объект Math
/*
Math.round(x) - Возвращает значение числа, округлённое до ближайшего целого. 
Math.floor(x) - Возвращает наибольшее целое число, меньшее, либо равное указанному числу. 
Math.random() - Возвращает псевдослучайное число в диапазоне от 0 до 1 
Math.min() , Math.max()  - Возвращает минимальное и максимальное значение.
// добавить другие методы Math
*/
//Случайное целое между min и max
/*var max=...;
var min=...;
Math.floor(Math.random() *  (max ­- min + 1)) + min;*/

//Глобальный объект Date (не корректно работает в firefox)
/*
Создание даты: 
dateObj = new Date() 
dateObj = new Date(dateVal) 
dateObj = new Date(year, month, date[,  hours, minutes, seconds, ms] )
*/
/*dateObj = new Date(1999,6,12);		//работает только в chrome - ПОЧЕМУ?
console.log(dateObj);

dateObj = new Date("12.04.2009");	//работает только в chrome
console.log(dateObj);

dateObj = new Date(2018, 11, 6,  12, 45, 0, 0);
console.log(dateObj);*/

/*
Методы  
dateObj.getDay();  // Получить порядковый день недели
dateObj.getMonth(); // Получить порядковый месяц 
dateObj.getYear(); // Получить год 
// Сконструировать дату  
dateObj = new Date(2015, 05, 15);
*/

//Копирование массивов (объектов)    //нужно использовать спец ф-ции копирования объектов
/*var a = [1,2,3]; 
var b = a; 			//это некорректно!!!
console.log(a); //? 
console.log(b); //?
b[3] = 4; 
console.log(a); //?  a == b ????
console.log(b); //?
*/
//правильное копирование массива - через цикл
//функция клонирование массивов
/*function clone(arr) {		//попробовать через рекурсию сделать копирование массивов любой сложности
	let arr_new = [];
	for (let i in arr) {
		arr_new[i] = arr[i];
	}
	return arr_new;
}
c = [1,2,3,4,5];
console.log(clone(c));
//теперь проверяем
var a = [1,2,3]; 
var b = clone(a);  //теперь изменения в "b" не будут влиять на "a"
console.log('массив а:' + a); 
console.log('массив b:' + b);
b[3] = 4;
console.log('массив а, после изменения b:' + a);
console.log('новый массив b:' + b);
*/
//
//== при сравнении выполняет приведение типов
//=== при сравнении только сравнивает не преобразуя значение одного типа к другому
//console.log(true == 1);
//console.log(true === 1);
//результатом первого выражения будет true, потому что перед сравнением производится
// преобразование true -> 1, а затем сравниваются 1 и 1 соовтетственно результатом будет true
//результатом второго выражения будет false, потому что перед сравнением 
// НЕ производится преобразование true -> 1, а сравниваются true и 1, 
//соовтетственно результатом будет false, т.к. число не равно логическому значению.
//

//копирование многомерных массивов (пробуем рекурсию)
//.......


//факториал -  произведение всех натуральных чисел от 1 до n включительно (используем рекурсию)
/*function f(n) {
  if (n === 1) return 1;
  console.log()
  return n * f(n - 1);
}
alert(f(4));
*/
					//Стек вызовов(у рекурсивных вызовов)
//вывод чисел в обратном порядке - от переданного до 0 (с помощью рекурсии)
/*function write(n) {
	if (n>=0) {
		console.log(n);
		write(n-1);
	}
}
write(5);
*/
//числа функциейи ниже выведутся не в порядке убывания, а в порядке возрастания
//Дело в том, что код, расположенный после рекурсивного вызова функции (console.log(n)) 
//не выполняется сразу, а буде ожидать пока завершится рекурсивный вызов, 
//который, в свою очередь, может повлечь ещё один рекурсивный вызов и т.д. 
//Когда, наконец, функция перестанет вызывать сама из себя, начнётся выполнение кода
// после рекурсивного вызова функции для каждого вызова, начиная с последнего. 
//При каждом вызове функции создаётся и помещается в стек, так называемая запись активации,
// которая хранит значения локальных переменных и параметров функции, поэтому
// эти значения и не теряются после рекурсивного вызова. Стек это такой способ хранения данных, 
//при котором последнею запись можно извлечь, только после того, как были извлечены все предыдущие записи. 
/*function write(n) {
  if(n >= 0) {
    write(n - 1);
    console.log(n);
	}
}
write(6);
*/

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

//Принадлежность массиву
// 1)ищим по ключу (для ассоциативных массивов)
/*var ourClass = [];
ourClass['Юля']=1;
ourClass['Петя']=1;
ourClass['Вася']=1;
var st1 = 'Петя', st2 = 'Гена';
console.log(st1 in ourClass);
console.log(st2 in ourClass);
*/
// 2)метод indexOf - это метод массива (только для нумерованных массивов)
// indexOf возвращает индекс элемента если он есть в массиве, если элемента нет, то возвращает "-1"
/*var first5Letters = ['a', 'b', 'c', 'd', 'e'];
//это равносильно
//first5Letters[0] ='a';
//first5Letters[1] ='b';
var newLetter = 'g'; 
console.log(first5Letters.indexOf(newLetter)); //вернет -1(так как g нет в массиве)
newLetter = 'b';
console.log(first5Letters.indexOf(newLetter));	//вернет 1
newLetter = 'd';
console.log(first5Letters.indexOf(newLetter)); //вернет 3
*/
// 3) для объектов(они же ассоц.массивы)
/*var a = {};
a.i = 30;
// a["i"] = 30; //это же поле задали другим способом
console.log(a.i === undefined);	//сравниваем со значением "неопределено"
console.log(a.i2 === undefined);
//console.log(typeof(a.i) === undefined);	//задать вопрос!!!!!!(undefined не зарезервированное слово)
//console.log(typeof(a.i2) === 'undefined');
*/


//Задача поиска элемента в массиве (в лоб - перебором)
/*function contains(arr, elem) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] === elem) {
            return true;
        }
    }
    return false;
}
var my_arr = ['a', 3, -5, 'yes', 0];
//var my_elem = 'yes';
var my_elem = 'ye';
//var my_elem = 0;
//var my_elem = -6;
//var my_elem = -5;
console.log(contains(my_arr,my_elem));
*/

//генератор
//функция возвращает случайное число от 0 до переданного в функцию
/*gen_random = function(max) {
	var b = Math.round(Math.random() * max);
	return b;
}
console.log(gen_random(25));
*/


						/*Лекция 4*/

//метод .forEach
//для каждого элемента массива(который мы укажем) этот метод запускает ф-цию(которую мы передадим) по одному разу.
//этот метов передает в фунуцию три значения(всегда) - элемент, индекс этого элемента и сам массив(именно в этом порядке)
//Этот метод подходит если мы хотим для массива сделать какой-то перебор(вывести элементы, посчитать сумму...)
/*[2,3,4].forEach(function(el, idx, arr) {
     console.log('arr[' + idx + '] = ' + el + ' в [' + arr + ']'); 
});
*/
//написано тоже самое только длиннее
/*var arr = [2,3,4];				//объявили массив
var iter = function(el,idx,arr) {	//объявили переменную, ссылающуюся на функцию
	console.log('arr[' + idx + '] = ' + el + ' в [' + arr + ']');
}
arr.forEach(iter);	//вызываем метод forEach для массива(arr) и передаем в него функцию(iter)
//iter(2,0,[2,3,4]); - внутри forEach для первой итерации выглядит так(то есть 2- это элемент, 
// 0 - индекс этого элемента, [2,3,4] - сам массив)
*/
/*var sum = 0;
[2,3,4].forEach(function(el, idx, arr) {
     sum+= el;  //посчитать сумму
     console.log('arr[' + idx + '] = ' + el + ' в [' + arr + ']'); 
});
console.log(sum); //вывести сумму
*/


									//замыкание
//        "жизнь" переменной 
// в примере ниже объявлена функция getGen(), далее в области видимости внутри этой функции
// объявлена переменная sum и объявлена анонимная функция function(n)
/*
function getGen() {
	var sum = 0;
	return function(n) {
		sum = sum + n;
		return sum;
	}
}
//getGen - это ссылка на функцию
//getGen() - а это вызов функции
//function() {} - ссылка на функцию
//(function() {})() - вызов функции
var test = getGen();  //объявляем переменную, ссылающуюся на  результат выполнения функции getGen(), 
//а так как getGen() возвращает ссылку на ф-цию (function(n){...}), то test это ссылка на ф-цию function(){}. 
//То есть:
//test - это переменная,
//getGen() - это вызов функции, которая возвращает некоторое значение
//(в нашем случае возвращается ссылка на другую функцию),
//test = getGen() - в переменную test сохраняется то, что возвращает функция getGen()
//и теперь в test хранится ссылка на функцию.

// и пока у нас есть переменная(test), ссылающаяся на эту ф-цию "жива" и переменная sum.
// поэтому далее, передавая в переменную test одно и тоже значение, результат выполнения будет меняться -
// так как переменная sum еще "живет"(она сохраняет свое значение) и будет происходить 
// суммирование с прошлым значением переменной sum.
// Переменная sum "жива" только внутри функции!!! То есть снаружи ф-ции к ней не обратиться
console.log(test(1)); //выведет 1
console.log(test(1)); //выведет 2
console.log(test(1)); //выведет 3  //так как переменная sum еще "живет"
console.log(sum);	  //undefined - так как sum "жива" только внутри функции!!!
*/


					//Обработка событий на странице
//объект document - это объект всей страницы
//onclick - это ссылка на функцию, которая будет вызываться в момент наступления события "клик"
//то есть клика по объекту "document"(по любому месту на странице)
//и тогда(в данном примере) элемент(div или .....), по которому кликнули на станице будет с рамкой.
//Параметр onclick - это и есть функция, которая вызывается при клике. Она всегда есть, всегда определена.
//Правда, имеет по дефолту пустое значение. Т.е. ничего не делает по умолчанию.И вызвать её нельзя.
//Вызывает её и передаёт в неё параметр(именно "клик") некий код, скрытый от нас - это логика уже браузера.
//Мы переопределяем ф-цию, то есть напишем свою:
/*
document.onclick = function(event) {
	console.log(event);
	//у "клика"" есть поле(св-во) target(являющееся объектом) - он определяет куда был клик(на какой элемент страницы)
	//Таргет - это объект дочерний для документа, соответствующий конкретному элементу дом дерева.
	// Он находится в Dom. В момент возникновения события, этот объект прикрепляется к объекту события
	// к полю target. Т.е. таргет начинает ссылаться на этот объект.
	console.log(event.target); 	//то куда мы кликнули(в какой элемент - <div> или <a> или ...)
								//то есть - event.target – это исходный элемент, на котором произошло событие
	//так же есть поле(св-во) style(тоже являющееся объектом)
	// стайл у объекта, на который ссылается таргет, есть всегда.
	//event.target.style - содержит все стили элемента target
	console.log(event.target.style); //св-ва(стили) элемента, на который кликнули
	
	//event.target.style.border = "1px solid black"; //если произошел клик, то сделать ему рамку черной
	//ВАЖНО: указывать в качестве цвета зарезервированные слова(red) или вариант rgb
	//если указать цвет HEX кодом, то он будет преобразовываться или будет ошибка

	//если мы хотим чтобы при нажатии делалась рамка, а при втором нажатии на тот же элемент рамка исчезала:
	if (event.target.style.border == '1px solid black') { //то есть проверяем: есть у элемента такой бордер
		event.target.style.border = '';						//если есть, то убираем
	} else {												//иначе(если нет бордера)
		event.target.style.border = '1px solid black'		//тогда делаем бордер
	}
	console.log(event.target.style.border); //выведем значение рамки нашего элемента
}
*/
// онклику присвоить функцию, в которой вывести в консоль массив атрибутов - наглядно будет видно, 
//что именно и в каком порядке передаётся в функцию.
/*
document.onclick = function(event) {
	console.log(arguments);
}
*/



//собственная библиотека работы с текстом

//функция - генератор строк
//Написать генератор случайных слов от 3 до 5 букв (размер - случайное число),
// где нельзя, чтобы подряд шли две согласные или две гласные буквы 
//(т.е. гласные и согласные должны чередоваться). При этом, гласность/согласность первой буквы 
//является случайным значением.
/*
//алгоритм - разбиваем на более мелкие ф-ции, решающие отдельные задачи

//словарь(строка из букв - сначала все гласные, потом согласные
// (индекс массива с первой согласной мы будем знать))
const symbols = 'aeyuioqwrtpsdfghjklzxcvbnm';
const v_counter = 6; //сколько гласных (для определения граници - где начинаются согласные)
const c_counter = 20;//не обязательна(сколько согласных)
//можно так определить //c_counter = symbols.length - 6;

//1) ф-ция должна возвращать word_counter кол-во слов...
function getRndText(word_counter) { //word_counter - кол-во слов, которое надо сгенерировать(его мы передаем)
	var rnd_text = [];
	for (var i=0; i<word_counter; i++) {
		var word_size = Math.round(Math.random()*2+3); //длина слова должна быть от 3-х до 5-и букв
		rnd_text.push(getRndWord(word_size));
	}
	return rnd_text.join(' '); //преобразуем массив в строку через разделитель(это делает сам join).
							   //разделитель передаем мы сами в качестве аргумента в join(это пробел)
}

//2) ф-ция должна возвращать случайное слово, но в слове должны чередоваться гласные и согласные,
//причем гласность/согласность первой буквы является случайным значением.
function getRndWord(word_size) {
	var str = '';
	str += getSymbol();
	while (str.length < word_size) {
		if (isVowel(str[str.length - 1]))
			str += getSymbolC();
		else
			str += getSymbolV();
	}
	return str;
}
//3)ф-ция вщзвращает гласную букву
function getSymbolV() {
	return symbols[Math.round(Math.random()*(v_counter - 1))];
	//return symbol.charAt(Math.roound(Math.random()*(v_counter - 1)));
}
//4)ф-ция вщзвращает согласную букву
function getSymbolC() {
	return symbols[Math.round(Math.random()*(v_counter - 1) + v_counter)]; //???????
}
//5)ф-ция возвращает любую случайную букву
function getSymbol() {
	return symbols[Math.round(Math.random()*(v_counter + c_counter - 1))];//или return symbols[Math.round(Math.random()*25)
}
//6)ф-ция определяет гласная или согласная(возвращает true если гласная и false если согласная)
function isVowel(symbol) {
	return (symbols.indexOf(symbol) < v_counter); //сравниваем индекс элемента
}
console.log(getRndText(25));
*/



					/*Лекция 5*/

//функции
/*
function t() {
	return 1;
}
console.log(t);		//выводим ссылку на ф-цию
console.log(t());	//вызываем ф-цию и выводим результат ее работы

var t2 = t, t3 = t();
console.log(t2);
console.log(t2());
console.log(t3);
//console.log(t3()); //ошибка - не является функцией

var t = function() {
	return 1;
}
var t2 = t;
console.log(t);
console.log(t2);
console.log(t());
console.log(t2());
*/

//рекурсия
//рассчет заданного числа Фибонначи с использованием рекурсии
//Число Фибонначи - каждое последующее число равно сумме двух предыдущих чисел
//(а первые два числа либо 0 и 1, либо 1 и 1).
//1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597 … 
/*
function fibRec(n) {
	if (n === 1 || n === 2) { //или
		return 1;
	} else {
		return fibRec(n-1) + fibRec(n-2);
	}
}
console.log(fibRec(6));
//то есть есть ряд Фибонначи
//0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597 …
//и есть ряб чисел
//0, 1, 2, 3, 4, 5, 6, 7 .......... - соответственно для числа 6, число Фибонначи будет 8, для 7 - 13
*/

//Написать рекурсивную функции pow(x, n) вычисляющую возведение числа x в степень n, 
//где n – положительное целое число.
/*
function pow(x, n) {
	if (n === 1) {
		return x;
	} else {
		return x * pow(x, n-1);
	}
}
console.log(pow(3,6));

//тот же результат, но без рекурсии
function powNoRec(x,n) {
	var rez = x;
	for (i =1 ; i < n; i++) {
		rez *= x;
	}
	return rez;
}
console.log(powNoRec(3,6));
*/


//замыкание
/*
function outName(){
    if(arguments[0] !== undefined) name = arguments[0];
    if(arguments[1] !== undefined) lastname = arguments[1];
    // name и lastname - переменные не объявлены внутри ф-ции, значит идет обращение к области выше,
    // но там их тоже не находит. ТОГДА эти переменные создаются сами в глобальной области видимости
    alert(getName() + ", " + arguments.length);
    function getName(){ return name + " " + lastname; }
}
console.log(outName("Иван", "Иванов")); // выведет "Иван Иванов, 2" 
console.log(outName());			//выведет "Иван Иванов, 0" - хоть и не передали аргументов,
								// но  name и lastname вывелись, так как значения этих переменных 
								// сохранены
*/

//Используя замыкания написать функцию-счётчик, которая считает свои вызовы и возвращает их текущее число.
//паттерн - "Фабрика"
/*
function getCounter() {
	var x=0;
	return function() {
			return ++x; //то есть сначала прибавляет, 
						//потом возвращает новое значение x
			}
}
var counter = getCounter();
console.log('кол-во вызовов counter: ' + counter());
console.log('кол-во вызовов counter: ' + counter());
console.log('кол-во вызовов counter: ' + counter());
console.log('кол-во вызовов counter: ' + counter());
console.log('кол-во вызовов counter: ' + counter());
console.log('кол-во вызовов counter: ' + counter());

//каждой переменной, которая будет ссылкой на ф-цию function()
// будет создаваться своё лексическое окружение и пока будет 
//сохраняться эта переменная всё лексическое окружение будет сохранено

//то есть если сделаем несколько переменных, ссылающихся 
//на одну и ту же функцию, то будет создано для каждой свое
//лексическое окружение(в разных областях памяти) и для каждой 
//будут сохраняться внутренние параметры(пока существует ссылка(ссылки))
var cl = getCounter();
var cr = getCounter();
console.log('кол-во вызовов cl: ' + cl());
console.log('кол-во вызовов cl: ' + cl());
console.log('кол-во вызовов cl: ' + cl());
console.log('кол-во вызовов cr: ' + cr());
console.log('кол-во вызовов cl: ' + cl());
*/

					//передача ф-ции в качестве аргумента - callback
/*
function filter(arr, rule) {
    var result = [];
    for(var i in arr) {
        if( rule(arr[i]) ) result.push(arr[i]);
	}
return result;
}
//делаем правило отбора - только четные числа
function getEven(n) { return n % 2 === 0; } // Even/Odd(четные/нечетные)
//задаем массив
var testArr = [1,4,7,23,-4,0,3, 88];
//вызываем ф-цию и результат ее работы записываем в новый массив
var newArr = filter(testArr, getEven);
//выводим в консоль
console.log(newArr);
*/
//создать ф-цию фильтрации для фильтрации простых чисел(чтобы новый массив содержал только простые числа)
//простое число делиться без остатка на само себя и на единицу
/*
function filter(arr, rule) {
	var result=[];
	for (var i in arr) {
		if ( rule(arr[i]) ) result.push(arr[i]);
	}
	return result;
}
//ф-ция отбора постых чисел
function getEasy(n) {
	for (var i=2; i < n; i++) { 	//то есть перебираем числа от двух до переданного в эту ф-цию значения
									//если при делении n на число из диапозона у нас НЕ будет остатка, то число n 
									//не простое(потому что делиться без остатка не только на себя и единицу)
		if (n%i == 0)
			return false;
	}
	return true;
}
var testArr = [1,23,0,44,6,5,9];
var newArr = filter(testArr, getEasy);
console.log(newArr);
*/


								// лекция 6

/*
	//методы объекта document
// Поиск элементов в DOM
// По id элемента
console.log(document.getElementById("content-holder"));
console.log(window['content-holder']);
console.log(window.content);
//По тегу или по имени
console.log(document.getElementsByTagName('div'));
// Все элементы
console.log(document.getElementsByTagName('*'));
// По имени
console.log(document.getElementsByName('age'));
//По классу и вложенный поиск
console.log(document.getElementsByClassName('cl1')[0].getElementsByClassName('cl2'));
//По css-селектору и хранение результатов
var elements = document.querySelectorAll('div > div:first-child')
var element = document.querySelector('div > div')
console.log(elements);
console.log(element);
*/


//Событие “загрузка дом-дерева”
/*
document.addEventListener('DOMContentLoaded', function(){ 
    // Ваш код здесь
});
*/
/*
document.addEventListener('DOMContentLoaded', function(){ 
 // Поиск элементов в DOM
// По id элемента
	console.log(document.getElementById("content-holder"));
	console.log(window['content-holder']);
	console.log(window.content);
//По тегу или по имени
	console.log(document.getElementsByTagName('div'));
// Все элементы
	console.log(document.getElementsByTagName('*'));
// По имени
	console.log(document.getElementsByName('age'));
//По классу и вложенный поиск
	console.log(document.getElementsByClassName('cl1')[0].getElementsByClassName('cl2'));
//По css-селектору и хранение результатов
	var elements = document.querySelectorAll('div > div:first-child')
	var element = document.querySelector('div > div')
	console.log(elements);
	console.log(element);
});
*/

//Неправильное использование замыканий
/*
function addEvents(divs) { // на каждый див вешаем обработчик клика и должен быть вывод номер дива, на который кликаем
    for(var i=0; i<divs.length; i++) {  
            divs[i].innerHTML = i // содержимое html документа(которое выбрано(divs[i]))
            divs[i].onclick = function() { alert(i) } //всегда выводит 10
        }
}
*/
/*
function makeDivs(parentId) { //внутри элемента с переданным ID(parentId) создает 10 дивов и раскрашивает в разные цвета
    //alert('qqqqqq');
    for (var i=0;i<10;i++) {
        var j = 9-i;
        var div = document.createElement('div');
        div.style.backgroundColor = '#'+i+i+j+j+j+i
        div.style.height = '30px';
        div.className="closure-div"
        div.style.color = '#'+j+j+i+i+i+j
        document.getElementById(parentId).appendChild(div)
    }
}

//Правильный вариант 1
function getAlert(x) { return function() {alert(x);} } //вернет ссылку на ф-цию(генератор оповещений)
function addEvents2(divs) {
    for(var i=0; i<divs.length; i++) {    
        divs[i].innerHTML = i;
        divs[i].onclick = getAlert(i);
    }
}

//Правильный вариант 2
function addEvents3(divs) {
    for(var i=0; i<divs.length; i++) {    
        divs[i].innerHTML = i
        divs[i].onclick = function(x) {
            return function() { alert(x) }
        }(i) //сразу вызвали анонимную ф-цию
    }
}



document.addEventListener('DOMContentLoaded', function(){
	console.log(makeDivs('Parent'));
	//console.log(addEvents('Parent'));
	//console.log(addEvents2(document.getElementById("Parent").childNodes));
	console.log(addEvents3(document.getElementById("Parent").childNodes));
});
*/

/*
Задача 3
Написать функцию, которая выполняет операции сложения, вычитания, умножения и деления над двумя числами.
На вход функция принимает текстовую строку с выражением. На выходе функция возвращает результат вычисления.
Текстовая строка на входе может содержать только следующие символы (в любом количестве):
цифры;
знаки операций +, -, *, /;
знак пробела.
Примеры выражений на входе функции:
2 + 2
3-1
4*      6
6                   /                      3
*/

/*
var expression = prompt('Введите алгебраическое выражение:');

function cTrim(str) { // принимает исходную строку, удаляет пробелы , возвращает строку без пробелов
	var new_str = [];
	var j=0;
	for (i in str) {
		if (str[i] !=' ') {
			new_str[j] = str[i];
			j++;
		} 
	}
	return new_str; //преобразуем в строку
}
//осуществить перебор массива до первого вхождения "не числа"(знаки операций)
function parseString(str) { //принимает текстовую строку, возвращает объект с полями(1-й операнд, 2-й операнд, знак операции)
    var f = cTrim(str); // удаляем пробелы
    var opns = ['+', '-', '*', '/'], //массив символов операций
		obj = { //объект для определения операндов и операции
    		opd1: '',	//поле для первого операнда
    		opd2: '',	//поле для второго операнда
    		opn: ''		//поле для знака опчерации(+,-,*,/)
		},
		i = 0, //счетчик для перебора строки(указатель на текущий символ)
		len = f.length;
    for(; i<len; i++) { // цикл начинает работать проверяя условие i<len
        if( opns.indexOf( f[i] ) == -1) { //если "не знак" операции,то складываем в строку(в opd1)
            obj.opd1 += f[i];//String( f[i] ); //на всякий случай преобразуем в строку
		} else { //если знак операции, то запоминаем его в opn
    		obj.opn = f[i];
    		i++;
    		break;
		}
	}
	for(; i<len; i++) { // собираем вторй операнд(opd2) // цикл начинает работать проверяя условие i<len
    	obj.opd2 += String( f[i] ); //на всякий случай преобразуем в строку
	}
return obj;
}

function calculate(o) { //ф-ция осуществляет операцию(+,-,* или /) над операднами.
						//принимает объект, поля которого содержат операдны и операцию
    //console.log(o);
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
}

console.log(calculate(parseString(expression)));
*/


								//  Лекция 7

							//объект window
//объект window - объект для взаимод с окном браузера и с самим браузером

//сначала дождаться события - формирования ДОМ дерева(document.addEventListener('DOMContentLoaded', function())
//window.open('http://ya.ru'); //переход на указанную страницу
//window.scrollTo(0, 1000);  //крутим экран на позицию
//window.scrollY;  //текущ полож по вертик
//window.localStorage; // хранилище (локальное) позволяет передавать данные между страницами(даже если закрыли браузер)ю хранить параметры пользователя, история его действий...

//window.location; // ссылка  - показывает текущее положение документа
//window.location.href = 'http://ya.ru';

//BOM
//BOM - это объектная модель браузера. Это объекты для работы со всем, кроме самого документа.

//DOM
//document
//объект документ образуется после формирования страници и наследуем методы от объекта window

//Node
//Node это интерфейс, от которого наследуют несколько типов DOM, 
//он так же позволяет различным типам быть обработанными(или протестированными).
//Основные методы и свойства:
//Node.childNodes
//Node.firstElementChild 
//Node.lastElementChild 
//Node.nextElementSibling
//Node.previousElementSibling 
//Node.parentElement 
//Node.textContent

//вместо Node подставим, например, нужный элемент
/*
document.addEventListener('DOMContentLoaded', function() {
	var div = window.test; //в документе ищем элемент с ID test
	console.log(div.childNodes); //дочерние элементы
	console.log(div.firstElementChild);
	console.log(div.lastElementChild);
	console.log(div.nextElementSibling);
	console.log(div.previousElementSibling);
	console.log(div.parentElement);
	console.log(div.textContent);
 

});
*/
//интерфейс EventTarget - содержит методы для работы с событиями
//EventTarget.addEventListener()  - Регистрирует обработчик событий указанного типа на объекте.
//EventTarget.removeEventListener()  - Удаляет обработчик события.
//EventTarget.dispatchEvent()  - Генерирует событие на объекте EventTarget.
//объекты ДОМ наследует этот интерфейс

//вывести текст внутри обзаца <p>Абзац 1</p> (смотри в forjs.html)
/*
document.addEventListener('DOMContentLoaded', function() {
	//var p = window.test;
	//var m = p.firstElementChild;
	//console.log(m.nextElementSibling.textContent);
	//console.log(m.nextElementSibling.innerText); //тоже самое
	//console.log(p.firstElementChild.nextElementSibling.innerText); //тоже самое
	//console.log(window.test.firstElementChild.nextElementSibling.innerText); //тоже самое
	//или
	var p2 = window.test.firstElementChild.nextElementSibling;
	console.log(p2.innerText);

	p2.innerText = "Абзац <span>1</span>"; //вставит что написано вместо "Абзац1"
	p2.innerHTML = "Абзац <span>1</span>"; //создаст тег на странице html в указанном месте(куда указывает p2)

	//window.test.append(p2.cloneNode(true)); //вызываем метод append для элемента с ID test и передаем туда ....
	//window.test.append(p2.cloneNode(true));
	//window.test.append('Абзац <span>1</span>'); //вместо элемента передаем текстовую строку

});
*/

			// Навигация по узлам

//задача
//Отталкиваясь от элемента с id=”startEl”(смотри в forjs.html) замените:
//“Текст 1” на ссылку “<a href=’#’>Текст ссылки</a>”;
//“Текст 2” на “Текст 3”.
/*
document.addEventListener('DOMContentLoaded', function() {
	var el = window.startEl.lastElementChild;
	el.innerHTML="<a href='#'>Текст ссылки</a>"; //меняем Текст 1 внутри <p> на <a href='#'>Текст ссылки</a>
	var el2 = window.startEl.nextElementSibling.lastElementChild.firstElementChild;
	el2.innerHTML = 'Текст 3'; //меняем Текст 1 на Текст 3
});
*/

// Свой обработчик событий
/*
Создать два счетчика. Первый начиная с 6го вызова должен выводить в консоль сообщение “Превышение 1”. 
Второй начиная с 6го - “Превышение 2”.
// Коллбек = обработчик события
// Событие - 6-ой и все последующие вызовы счетчика
function getCounter(f) {  //f -обработчик события
    var i = 0;
    return function() {
        i++;
        if(i>5) f();
        return i;
}
}
*/
/*
var point = 0;  //для отладки
var getCounter = function(f) {  //ф-ция генератор
								//передаем в качестве аргумента ф-цию f(она обработчик события)
    var i = 0;
    return function() {
        i++;
        if(i>5) f();
        return i;
	}
}

var handler = function() { //ф-ция - обработчик события1
	console.log('Превышение 1');
}
var handler2 = function() { //ф-ция - обработчик события2
	console.log('Превышение 2');
}

var a =getCounter(handler); //создали счетчик a
a();a();a();a();a();a();a();a(); // вызвали 8 раз счетчик a
var b = getCounter(handler2); //создали счетчик b
b();b();b();b();b();b();b();  // вызвали 7 раз счетчик b
*/

// задача
//Отладка состояния замыкания
/*
var point = 0;	//для отладки
function getArrayOfF() {
    var a = [];
    var i = 0;
    for(i=0; i<5; i++){
        a.push(				//добавляем в массив элемент, который является ф-цией
            function() {	//ф-ция только объявлена(она здесь еще не вызывается)
                return i;	//возврат значения i, но только после вызова этой ф-ции
            }
        );
    }
    return a;	//возврат массива, при этом i=5
}
// Пример вызова
var arr = getArrayOfF(); //ссылка на результат выполнения ф-ции, так как ф-ция возвращает массив, то arr ссылка на массив
arr[3](); //!!!! вернет 5 - arr массив, элементы котого ф-ции. Мы обращаемся к элементу массива arr[3] ,
			//а arr[3]() - это вызов ф-ции, являющейся элементом массива.
			//Данная ф-ция должна вернуть значение i. Когда мы вызываем эту ф-цию она попадает в лексическое окружение
			//ф-ции getArrayOfF, а там значение i=5, так как цикл уже отработал
*/



								// Лекция 8

//Function Expression vs Function Declaration
//Function Declaration – функция, объявленная в основном потоке кода.
//Function Expression – объявление функции в контексте какого-либо выражения, например присваивания.

//Function Declaration - Результат - именованная функция, хранимая в переменной <name>.
//Создаются интерпретатором ДО объявления.

//Function Expression - Результат - анонимная функция, хранимая в переменной <name>.
//Создается интерпретатором в тот момент, когда встречается в скрипте, 
//т.к. перед запуском скрипта интерпретатор ищет ТОЛЬКо Function Declaration.


//Следствие 1
/*
console.log(f1); 
//Function Declaration
function f1(n) {
    console.log(n);
}

console.log(f2); //не вызовется, так как объявлена ниже
//Function Expression
var f2 = function(n) {
    console.log(n);
}
*/
/*
//Следствие 2 (ошибка)
//“use strict”
if(x > 1) {
function f(x) {return 1;}
} else {
    function f(x) {return x;}
}
console.log(f);


//Следствие 2
//“use strict”
var f;
if(x > 1) {
f = function{return 1;}
} else {
    f = function{return x;}
}
f(x);
*/

/*
function() {					//будет ошибка
  alert('Function Expression');
}
//Function Expression
+function() {
  alert('Function Expression');
}
!function() {
  alert('Function Expression');
}

(function() {
  alert('Function Expression');
})

console.log((function() {alert('Function Expression');}));
*/

//Вызов "на месте"
/*
function fd() {
  alert('Function Declaration call error');
}(); //последние скобки это и есть вызов ф-ции, а так как вызов сразу после объявления ф-ции, то и называется вызов на месте

+function() {
  alert(“Function Expression call work”);
}();
*/

						//модульное программирование

//Модули через замыкания
/*
// Пустой модуль
;(fuction() { // скобки для того чтоб показать что это Function Expression
				// ; стоит чтобы при "склеивании" с другим кодом обезопасить этот код

})();  // () значит вызываем на месте
// этим мы создали свою область видимости
//Внутри происходит что угодно, объявляются свои локальные переменные, функции.
//В window или наружу через return выносится то, что нужно снаружи.
*/
//Первая реализация
/*
;(fuction() {
    // … реализация и создание точки входа <name> - основной объект
    window.<name_g>  = <name>;
});
*/
//теперь снаружи к объекту name можем обращатся двумя способами
//window.<name_g>
//<name_g>

/*
//Вторая реализация
;var <name_g> = (fuction() {
    // … реализация и создание точки входа <name> - основной объект
    return <name>;
})
*/

//Структура основного объекта(модуля) - точки входа
// Является интерфейсом к модулю
// Пример - математический модуль для сложения числа с предыдущим числом

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



//ф-ция для разбиения строки с алгебраическим выражением на "одиночные" операции(+, -, :, /)
//то есть идем от + и - к * и / - разбиваем выражение на простые составляющие
// на первом шаге (1)  +  (2 * 3 - 4 + 5 / 6)
//далее делим (2 * 3 - 4 + 5 / 6) на (2*3) - (4 + 5 / 6) и тд
  //var f = '1 + 2 * 3 - 4 + 10/5';
  //console.log(parseString(f));
/*
function parseString(fr) { //(см. ниже эту ф-цию)
	// '1 + 2 * 3 - 4 + 5 / 6'
	//if (+fr != NaN) return +fr; //проверяем - если число, то вывести результат (+ значит пытаемся преобразовать в число)
								//и если это число, то возвращаем его
	//или
	if (!isNaN(fr) ) return +fr;
	var pos = fr.indexOf('+'); //позиция символа
	var opd1,opd2; //для определения операндов
	if (pos > -1) {
		opd1 = fr.slice(0, pos); //slice - берет строку между указанными индексами
		opd2 = fr.slice(pos + 1); //если указали только один параметр, то от него и до конца
	} else {
		pos = fr.indexOf('-');
		if (pos > -1 ) {
			opd1 = fr.slice(0, pos); //slice - берет строку между указанными индексами
			opd2 = fr.slice(pos + 1); 
		} else {
			pos = fr.indexOf('*');
			if (pos > -1 ) {
				opd1 = fr.slice(0, pos); //slice - берет строку между указанными индексами
				opd2 = fr.slice(pos + 1); 
			} else {
				pos = fr.indexOf('/');
				if (pos > -1) {
                   opd1 = fr.slice(0, pos);
                   opd2 = fr.slice(pos + 1);
               }

			}
		}
	}
	var obj = {
		opd1: parseString(opd1),
		opd2: parseString(opd2),
		opn: fr.slice(pos, pos+1)
	}
	return calculate(obj);
};
*/
/*
function calculate(o) { //ф-ция осуществляет операцию(+,-,* или /) над операднами.
						//принимает объект, поля которого содержат операдны и операцию
    //console.log(o);
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

//другой вариант ф-ции 
function parseString(fr) {
   // getResult("1 + 2 * 3 - 4 + 5 / 6")
   // pos = 2
   if ( !isNaN(fr) ) return +fr;
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
*/


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
/*
var log = function(a, b, c) {
  console.log(a, b, c);
};

log(...['Spread', 'Rest', 'Operator']); //это то же самое если бы передали вот это log('Spread', 'Rest', 'Operator');
// то есть происходит преобразование из массива элементов в отдельные элементы
log(['Spread', 'Rest', 'Operator']);
log(['Spread', 'Rest', 'Operator'], 1, 2);
*/

//Лямбда-функции  -анонимная ф-ция без имени
/*
//1) вариант
function getEven(x) {return (x%2 == 0);}
//2) вариант - прямо в аргументе
var newArr = filter(testArr, function(x) {return (x%2 == 0);});
//можно сократить 
var newArr = filter(testArr, testArr, x=> x%2 == 0);
*/

/*
// Лямбда-функция для получения инкремента от одной переменной
x => x + 1; //объявление ф-ции - это тоже самое если бы написали function(x){return x+1;}
var inc = x => x + 1; //присвоили переменной ссылку на ф-цию
console.log(inc(2));
*/
/*
// Лямбда-функция без аргументов
() => 3.14
// Лямбда-функция с несколькими аргументами
(a1, a2, a3) => a1 + a2 + a3
// Лямбда-функция с несколькими аргументами и блоком
(a1, a2, a3) => {				//тоже самое если бы написали function(a1, a2, a3)
var res = a1 + a2 + a3;
// .. что-то еще
return res;
}
*/

//<p><strong>Hello</strong>how are you doing?</p>
/*
document.addEventListener('DOMContentLoaded', function(){ 
    // Ваш код здесь
    //document.getElementsByTagName('p'); //получим массив всех элементов p (у нас элемент один)
    var el = document.getElementsByTagName('p')[0]; //обращаемся к нулевому элементу
	console.log(el.lastElementChild);
	console.log(el.lastChild);

});
//Ноды есть разлчных типов
*/

/*
//создание нового элемента в ДОМ дереве - Создание новых элементов
document.addEventListener('DOMContentLoaded', function(){ 

// получим узел 
var parent = document.getElementsByTagName('p')[0];
// создадим пустой узел div
var child = document.createElement('div');
// добавим ему класс  
child.setAttribute('class', 'feed-container');
// добавим в родительский узел созданного ребенка 
//parent.appendChild(child); //добавляем в конец
// либо так 
parent.prepend(child); //добавляем в начало
//вставить после какого-то элементв(вместо null какой-то элемент)
//parent.insertBefore(child, null);
// замена - все содержимое p удалиться и будет только div
//parent.innerHTML = child; //замена содержимого

//удаление узла 
// получим родительский узел var 
var parent2=document.getElementsByTagName('p')[0];  //на самом деле parent и parent2 одно и тоже(просто для наглядности)
// получим дочерний узел 
var child2 =parent2.firstElementChild;
// удалим дочерний узел 
parent2.removeChild(child2);

});
*/





							//Вывести список категорий товаров
/*
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

//https://github.com/Satytan/lessons/blob/master/goods.js
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

//определяем нужный нам элемент html(то есть список ul, у которого класс class="catnav__listcat").
//document.getElementsByClassName('catnav__listcat') - возвращает массив, содержащий элементы данного класса.
// [0] - обращаемся к элементу с индексом 0, полученного массива. Соответственно, переменная list_c будет 
// ссылаться на нужный нам список ul
var list_c = document.getElementsByClassName('catnav__listcat')[0];

//нам нужно получить массив, содержащий названия катигорий товаров
cats = getCatListFromGoods(goods); // массив названия категорий
cats2 = getCatListFromGoodsWC(goods); // ассоц. массив (ключи - категории, значения - кол-во товара по категории)

//нужно для каждой найденной категории создать элемент списка(li) и вписать название элементу списка,
// соответствующее категории
cats.forEach(function(el, i, arr) {		//для каждого элемента массива cats метод forEach исполнит ф-цию(которую пишем мы)
										//, в ф-цию метод передает элемент, его индекс и сам массив
	var li = document.createElement('li'); //создаем элемент <li></li>
	li.innerText = el; // елементу списка добавляем название(то есть вставляем в элемент текст) - <li>название</li>
	list_c.appendChild(li); //в конец родительского элемента list_c(это у нас ul) добавляем li
	});

//написать Другой вариант вывода списка li
//нужно для каждой найденной категории создать элемент списка(li) и вписать название элементу списка и кол-во товара
//cats2 - ассоц. массив (ключи - категории, значения - кол-во товара по категории)

//Получить количество ключей и сами ключи ассоциативного массива можно так:
//Object.keys(cats2) - будет содержать нумерованный массив, элементы которого будут строки, содержащие название ключей
//ассоц массива(который мы указали). следавательно можно обращатся к элементам массива Object.keys(cats2) через индекс
//console.log('массив ключей ассоц массива ' + Object.keys(cats2));
//теперь можно получить длину ассоц массива
//console.log('длина ассоц массива '+ Object.keys(cats2).length);
//Проверить есть ли ключ в ассоциативном массиве можно так:
//console.log(cats2.hasOwnProperty("C2")); // вернет true или false
//или такой конструкцией
//if ("key1" in cats2) {
//  console.log("Ключ key1 есть в массиве!");
//} else {
//  console.log("Ключ key1 нет в массиве!");
//}
//Перебрать элементы ассоциативного массива (свойства объекта) можно выполнить с помощью цикла for...in:
//for(key in myArray) { //myArray - ассоциативный массив, key перебирается сам
//  console.log(key + " = " + myArray[key]);
//}

//var len_cats2 = Object.keys(cats2).length;
//for (var i=0; i<len_cats2 ; i++) {
//	var li = document.createElement('li'); //создаем элемент <li></li>
//	var key_cats2 = Object.keys(cats2)[i]; //обращаемся к элементам массива через индекс i 
	//(key_cats2 ключ масива cats для каждой итерации)
//	li.innerText = 'категория : ' + key_cats2 + ' кол-во товара : ' + cats2[key_cats2];
//	list_c.appendChild(li);
//}
//проще так
for (key in cats2) {
	var li = document.createElement('li'); //создаем элемент <li></li>
	li.innerText = 'категория : ' + key + ' кол-во товара : ' + cats2[key];
	list_c.appendChild(li);
}

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

		// конец задачи - Вывести список категорий товаров
*/


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