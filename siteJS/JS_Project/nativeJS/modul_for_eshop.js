// Модуль для ф-ции, на входе которой количество необходимых предложений, на выходе - текст из заданного кол-ва предложений
// Генератор предложений.
; (function() {
const alphabet = 'aeiouyqwrtpsdfghjklzxcvbnm'; //строка алфавита
const vowel_counter = 6;
const consonant_counter = 20;
//ф-ция генерирует одно предложение
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
//ф-ция возвращает случайное слово, на входе размер слова(кол-во букв в слове) + param(true - сделать первую букву слова
// заглавной/false - не делать заглавной)
var getRndWord = function(n_word, param) {
	var word = getLetter();//сначала слову присваиваем любую букву
	while(word.length < n_word) {
		if (isVowel(word[word.length-1]))
			word+=getConsonant();
		else
			word+=getVowel();
	}
	if (param) {
		word = UpperLetter(word);
	}
	return word;
}
//ф-ция делает первую букву слова заглавной
function UpperLetter (word) {
	var upper_word = word[0].toUpperCase() + word.substring(1);
	//console.log(upper_word);
	return upper_word;

}

//функция, которая генерирует текст, состоящий из нескольких предложений. На входе - нужное кол-во предложений +
// диапазон случайного количества слов в предложении - от... и до...(то есть на входе три параметра)
//Слова разделяются пробелом. Каждое предложение кончается точкой. Первая бкува предложения заглавная.
var getRndSentences = function(n_sentence, min_word, max_word) {
	var arr_sentences = []; //массив для предложений
	for (var i=0; i<n_sentence; i++) {
		var len = Math.round(Math.random()*(max_word - min_word) + min_word); //количество слов в предложении от.. до ..
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
	sentences: getRndSentences,
	one_sentence: generator,
	one_word: getRndWord
}
window.RndText = RndSent;//создали интерфейс

})();					//конец модуля - Генератор предложений
//console.log('генерируем текст из 10 предложений, случайное кол-во слов в предложении от 3 до 9: ');
//console.log(RndText.sentences(10, 3, 9));
//console.log('генерируем одно предложение из 5 слов: ');
//console.log(RndText.one_sentence(5));
//console.log('генерируем одно слово из 6 букв, первая заглавная: ');
//console.log(RndText.one_word(6, true));