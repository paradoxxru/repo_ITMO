// Пример скрипта с частичным использованием jquery
$(document).ready(function () {
    // Найти элемент список
    // printGoodsList($("#list"));

    // Получить список категорий из списка товаров
        // создаем пустой массив (категория=>кол-во товаров)
        var arr = [];
        // для каждого товара выполняем действие
        goods.forEach(function(el) {
            // Есть ли категория данного товара в массиве категорий
                if(arr[el.category] == undefined) {
                    // нет: добавляем новый элемент
                    // название категории => 1
                    arr[el.category] = 1;
                } else {
                    // да: увеличиваем значение счетчика товаров в этой категории
                    arr[el.category]++;
                }
        });
    // Находим элемент список, в который будем добавлять новые элементы
    var ul = $('#list');
    // Для каждой категории выполняем действия for(k in arr)
    for(key in arr) {
        // Создаем и выводим на экран новый элемент
        var li = $("<li>"+key+" <span>"+arr[key]+"</span></li>");
        ul.append(li);
        // <li>Категория <span>Кол-во товаров</span></li>
    }
});

function printGoodsList(ul) {
    // для каждого товара из goods выполнить действие
    goods.forEach(function(el) {
        // Создать элемент li
        // Добавить внутрь название
        // Добавить новый элемент в элемент-список
        ul.append("<li>" + el.name + "</li>");
    });
}