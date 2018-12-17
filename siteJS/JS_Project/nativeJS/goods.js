
 //ф-ция генерирует описание товара - пока заглушка
function getDescription() {
    return "Dgdf dg dfgdfg dfg.";
}
//ф-ция подачи картинки товара
function getImageGoods(ni) {
	return img = 'images/'+ni+'.svg';
}
//ф-ция генерирующая id для товара
function getIdGoods(n) {
	return str = 'id'+n;
}
//ф-ция генерирует объект товара
num_i = 0; //для картинок товара
function newGood(n) {
	num_i ++;
    return {
        name: 'G' + n,
        category: 'C' + Math.ceil(Math.random() * 5),
        cost: Math.ceil(Math.random() * 20) * 1000,
        description: getDescription(Math.ceil(Math.random() * 5)),
        weight: Math.ceil(Math.random() * 20),
		vogue: Math.ceil(Math.random() * 100),		//популярность(лекционная)
        popularity: Math.round(Math.random()*35),	//популярность
        image: getImageGoods(num_i),               //'images/electric_drill.svg'
        idnumber: 'id'+n               // getIdGoods() //или это поле добавим после формирования всего массива товаров
    }
}
//формируем массив объектов товаров
goods = [];
for(var i = 0; i < 20; i++)
    goods.push(newGood(i));
//console.log('массив goods первоначальный');
//console.log(goods);
//добавить каждому товару поле idnumber
for (var i=0; i < goods.length; i++ ) {
	goods[i].idnumber = getIdGoods(i);
}
//console.log('массив goods с полем idnumber');
//console.log(goods);