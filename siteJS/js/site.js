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

/*var a=0,b=0;	//гловальные переменные
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
var a=0;
let b=1; // нельзя переопределять let*/

/* исследование двумерного массива*/
var arr1 = new Array(); //объявляем пустой массив
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
}

/*все аргументы*/
/* функция возвращает сумму всех элементов, переданных в функцию */
/*function add() {
	let sum = 0;
	let len = arguments.length; 
	console.log(len);			//проверка длины
	for (let i = 0 ; i < len ; i++) {
		sum +=arguments[i];
		console.log(arguments[i]);	//проверка аргументов
	}
	return sum;
}
var result = add(2,4,6,8,10);
console.log(result);*/