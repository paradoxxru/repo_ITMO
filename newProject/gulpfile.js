

let gulp = require('gulp-v4'); // подключаем Ядро Gulp
/*возможно здесь будет другой вариант написания подключения (require('gulp')), ве зависит от версии gulp
если не заработает, то гуглить - "как подключить такую-то версию gulp"*/

let del = require('del'); // Подключаем библиотеку для удаления файлов и папок
let concat = require('gulp-concat'); // Подключаем gulp-concat (для конкатенации файлов, например css и js) 
let cleanCSS = require('gulp-clean-css'); // для минимизации css
let cssnano = require('gulp-cssnano');	  // тоже минимизация css
let rename = require('gulp-rename'); // Подключаем библиотеку для переименования файлов(для добавления суффикса .min)
//let uglify = require('gulp-uglifyjs'); // для сжатия(минимизации) JS - устаревшая
let uglify = require('gulp-uglify'); //для сжатия(минимизации) JS
let pump = require('pump'); // подключаем для gulp-uglify
let minify = require("gulp-babel-minify"); //вместо uglify(для минимизации js файлов)


//функция копирования файлов .html
function html() {
	console.log('html has been updated');
	return gulp.src('./dev/site/**/*.html') //то есть берем из dev/site все файлы с расширением html из всех подкаталогов
											//при это при копировании сохранится структура этих каталогов.
											//Если у нас есть файл second.html, находящийся в dev\site\raznoe , то
											//в папку /public/site он скопируется по тому же пути(public\site\raznoe)
		.pipe(gulp.dest('./public/site'));
}
gulp.task('html', html);	//затем такс вызывается из командной строки когда необходимо командой: gulp html

//можно объединить создание функции и создание таска:
//gulp.task('html', function(){
//	console.log('html has been updated');
//	return gulp.src('./site/**/*.html');
//		.pipe(gulp.dest('./public/site'));
//});

//функция копирования изображений (всех файлов из папки dev/site/images/ в /public/site/images с сохранением иерархии)
function images() {
	console.log('images has been updated');
	return gulp.src('./dev/site/images/**/*.*')
		.pipe(gulp.dest('./public/site/images'));
}
gulp.task('images', images);

//функция копирования всех файлов с расширением css из всех вложенных папок в /dev/site/css/
//иерархия найденных css файлов сохранится в конечной папке /public/site/css
function css() {
	console.log('css has been updated');
	return gulp.src('./dev/site/css/**/*.*')
		.pipe(gulp.dest('./public/site/css'));
}
gulp.task('css', css);

//функция удаления папки public
function clean() {
	console.log('Catalog /public has been deleted');
	return del('./public');
	//return del(['../public'], {force: true})  // Для удаления файлов во внешних директориях нужен параметр force
											  //например у нас папка public была бы "вне" папки проекта
}
gulp.task('clean', clean);

//функция конкатинации css (склеивание всех, указанных по шаблону, файлов css)
function css_concat() {
	console.log('concatenation was successful');
	return gulp.src('./dev/site/css/**/*.*')
		  //если вдруг нужно клеить конкретные файлы, то можно указать их вот так:
		  //gulp.src(['./dev/site/css/main_css.css' , './dev/site/css/one/one.css' , './dev/site/css/two/two.css'])
		.pipe(concat('new_css.css')) //название нового склеенного файла
		.pipe(gulp.dest('./public/site/css'));
}
gulp.task('concatCSS', css_concat);

//ф-ция минимизации css  - в конечной папке сохраниться иерархия из ./dev/site/css/ ,но конечные файлы будут
//минимизированы(удалены все пробелы и записаны в одну строчку) - то есть приведены в нечеловеко-читабельный вид
//Чтобы получить один минимизированный файл css из всех, то надо сделать до минимизации еще конкатенацию
function min_css() {
	return gulp.src('./dev/site/css/**/*.*')
		.pipe(concat('new_css.css')) //сначала сделать конкатинацию(объединяем в один файл new_css.css)
		.pipe(cleanCSS())			 //затем минимизировать (можно попробовать наоборот - сначала минимизация)
		.pipe(rename({suffix: '.min'})) //переименовываем - добавляем суффикс .min (для удобства восприятия)
		.pipe(gulp.dest('./public/site/css'));
} 
gulp.task('min_css', min_css);

//тоже минимизация css. работает подобно cleanCSS() (в конечной папке сохраниться иерархия из ./dev/site/css/ ,но конечные файлы будут
//минимизированы), поэтому нужно сначала сделать конкатенацию. НО МИНИМИЗИРУЕТ лучше - объединяет св-ва одинаковых
//тегов или идентификаторов - то есть если у нас есть в разных css файлах св-ва для body, то в минимизированном файле
//эти св-ва будут объединены
function min_css_v2() {
	return gulp.src('./dev/site/css/**/*.*')
		.pipe(concat('new_css2.css')) //сначала сделать конкатинацию(объединяем в один файл new_css2.css)
		.pipe(cssnano())			  //теперь минимизируем
		.pipe(rename({suffix: '.min'})) // переименовываем - добавляем суффикс .min (для удобства восприятия)
		.pipe(gulp.dest('./public/site/css')); //помещаем в /public/site/css
}
gulp.task('min_css_v2', min_css_v2);

//ф-ция конкатинации и минимизации js файлов(работает только конкатенация)
function js_cancat_min() {
	return gulp.src('./dev/site/js/**/*.*')
		.pipe(concat('all_js.js'))
		//.pipe(uglify()) // выдает ошибки при минимизации
		//.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('./public/site/js'));
}
gulp.task('js_cancat_min', js_cancat_min);
//пробуем по другому ф-цию минимизации js файлов
function minjs(cb) {
	pump([
        gulp.src('./dev/site/js/**/*.*'),
        uglify(),	// тоже ошибка при минимизации
        gulp.dest('./public/site/js')
    ],
    cb
  );
}
gulp.task('minjs', minjs);
//пробуем минификацию js с помощью babel - работает, минимизация происходит(имена файлов и их количество
// остаются теми же, просто минимизируются)
function minify_js() {
	return gulp.src('./dev/site/js/**/*.*')
		.pipe(minify())
		.pipe(gulp.dest('./public/site/js'));
}
gulp.task('minify_js', minify_js);

//просмотреть все имеющиеся(созданные) таски можно из коммандной строки(из папки где развернут gulp)
// gulp --tasks  и выведутся имена всех тасков.
//запуск тасков(из коммандной строки): gulp имя_таска