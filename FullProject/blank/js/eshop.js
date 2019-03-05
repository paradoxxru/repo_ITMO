//Глобальные переменные
var e_catalog, // Ссылка на html-элемент, в котором лежит каталог
    e_cart, // Ссылка на html-элемент, в котором лежит отображение корзины
    e_cart_mini, // Мини-корзина вверху экрана
    e_goods, // Ссылка на html-элемент, в котором лежит отображение страницы товара
    goods, // глобальный массив с товарами
    cart = []; // глобальный массив с корзиной

// Основная логика приложения.
// Запускается только после полной загрузки ДОМ-дерева.
// Следующим шагом идёт загрузка через аякс товаров.
// Далее определяеются все обработчики событий и поведение всех элементов.
document.addEventListener(
    'DOMContentLoaded', // Ожидаем события "ДОМ-дерево сформировано"
    function(e) {
        // ДОМ-дерево сформировано и мы можем сохранить в соответствующие переменные
        // ссылки на основные элементы ДОМ-дерева, которые понадобятся нам в дальнейшей работе
        e_catalog = document.getElementsByClassName('catalog')[0];
        e_cart_mini = document.getElementById('Cart');
        e_cart = document.getElementsByClassName('cart')[0];
        e_goods = document.getElementsByClassName('goods')[0];
        // Очищаем элементы от лишних тегов
        document.getElementsByClassName('filter__categories')[0].innerHTML = "";
        e_catalog.innerHTML = "";
        // Через аякс отправляем запрос на загрузку товаров
        $.post('http://r2ls.ru', // адрес страницы сервера с товарами
            {}, // параметры, которые передаются серверу - мы ничего не передаём, но можем
            // Например, сервер умеет отдавать различное количество товаров по параметру count
            // Задать этот параметр можно следующим образом: {count: 10}
            // Список параметров:
            // count - количество возвращаемых товаров
            // cat_count - количество разных категорий
            // cat_name - принцип формирования названий категорий (приер: {cat_name: "old-name"}. Два принципа:
                // old-name - старый формат "C" + номер
                // любое другое значение - рандомное предложение из 1-2 слов
            function(data) { // Когда от сервера придёт ответ, запустится эта функция. Здесь мы и разместим все описание нашей программы.
                // Преобразуем ответ из json-формата в обычный массив и сохраняем в глобальной переменной goods
                goods = JSON.parse(data);
                // Отрисовываем каталог товаров
                printCatalog(goods, e_catalog);
                // Формируем список категорий из товаров и отрисовываем его
                printCategories();
                // Формируем и выводим ссылки для фильтрации по цене
                printCostFilter();
            }
        );

        // Указываем обработчики для различных случаев
        // Сортировки
        document.getElementById("CostUp").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortCostUp);
            printCatalog(goods, e_catalog);
        };
        document.getElementById("CostDown").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortCostDown);
            printCatalog(goods, e_catalog);
        };
        document.getElementById("WeightUp").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortWeightUp);
            printCatalog(goods, e_catalog);
        };
        document.getElementById("WeightDown").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortWeightDown);
            printCatalog(goods, e_catalog);
        };
        document.getElementById("VogueUp").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortVogueUp);
            printCatalog(goods, e_catalog);
        };
        document.getElementById("VogueDown").onclick = function() {
            e_catalog.innerHTML = "";
            goods = sort(goods, sortVogueDown);
            printCatalog(goods, e_catalog);
        };
        // Обработчик открытия корзины
        document.getElementById("Cart").onclick = function() {
            // Очищаем все контейнеры: каталог, страницу товара, саму корзину
            e_catalog.innerHTML = "";
            e_cart.innerHTML = "";
            e_goods.innerHTML = "";
            // создаем таблицу
            var table = document.createElement('table');
            // Добавляем шапку таблицы
            table.innerHTML = "<tr><th>Название</th><th>Количество</th><th>Цена</th><th>Стоимость</th></tr>";
            // Выводим все товары из корзины на страницу (добавляем в таблицу)
            // При этом, заодно, подсчитываем сводные данные
            var total_count = 0, total_sum = 0, row;
            for(k in cart) {
                total_count += cart[k]['count'];
                total_sum += cart[k]['count'] * cart[k]['cost'];
                row = document.createElement('tr');
                row.innerHTML = "<td>" + k + "</td>" +
                    "<td>" + cart[k]['count'] + "</td>" +
                    "<td>" + cart[k]['cost'] + "</td>" +
                    "<td>" + (cart[k]['count'] * cart[k]['cost']) + "</td>";
                table.append(row);
            }
            // Завершаем таблицу сводных итоговых данных
            row = document.createElement('tr');
            row.innerHTML = "<td><b>Итого</b></td>" +
                "<td>" + total_count + "</td><td></td>" +
                "<td>" + total_sum + "</td>";
            // Выводим ссылку для закрытия корзины и возвращения в каталог
            e_cart.innerHTML = "<a href='#' data-action='OpenCatalog'>X</a>";
            // Выводим само содержимое корзины, которое мы сформировали
            table.append(row);
            e_cart.append(table);
        };
        // Обработчик для всех остальных ссылок
        document.onclick = function (e) {
            // В этом обработчике брабатываем только те ссылки, у которых указан атрибут data-action
            // Также собираем и другие атрибуты, которыми описываем действия, которые должны выполняться по клику
            var action = e.target.attributes.getNamedItem('data-action'), // действие (сортировка, фильтрация, что-то еще)
                dtype = e.target.attributes.getNamedItem('data-type'), // для фильтрации - тип сравнения: больше значения, меньше значения, равно значению
                dfilter = e.target.attributes.getNamedItem('data-filter'), // имя поля, по которому фильтруем: цена, вес и т.д.
                dvalue = e.target.attributes.getNamedItem('data-value'); // конкретное значение, с которым сравниваем. например, имя конкретной категории, товары из которой надо оставить
            var new_goods; // Промежуточный массив с отфильтрованными товарами
            if (action != undefined) {
                // Обработчик всех фильтраций - атрибут "action" у ссылки имеет значение "filter"
                if(action.value == "filter") {
                    // Обработка фильтров
                    if(dtype.value == "equal") {
                        new_goods = filter(goods, dfilter.value, is_equal, dvalue.value);
                    } else if(dtype.value == "greater") {
                        new_goods = filter(goods, dfilter.value, is_greater, dvalue.value);
                    } else if(dtype.value == "less") {
                        new_goods = filter(goods, dfilter.value, is_less, dvalue.value);
                    }
                    // Очищаем все контейнеры: каталог, страницу товара, саму корзину
                    e_catalog.innerHTML = "";
                    e_cart.innerHTML = "";
                    e_goods.innerHTML = "";
                    // Вывод результата фильтрации
                    printCatalog(new_goods, e_catalog);
                } else if(action.value == "add-cart") { // Добавление в корзину - атрибут "action" у ссылки имеет значение "add2cart"
                    var goods_name = dvalue.value;
                    // Ищем данный товар в корзине
                    if (cart[goods_name] != undefined) {
                        // Если нашли, то увеличиваем количество
                        console.log(cart[goods_name]);
                        cart[goods_name].count++;
                    } else {
                        // Если такого товара еще не было, то добавляем первый
                        // Сначала находим цену товара (отталкиваемся от нажатой ссылки) через несколько шагов
                        // Шаг 1 - находим родительский элемент для ссылки, т.к. в нем лежит вся информация о текущем товаре, в т.ч. элемент, который содержит цену товара
                        // Т.к. ссылка лежит в спане, который уже, в свою очередь, лежит в нужном нам диве, то берем родителя два раза
                        var target_parent = e.target.parentNode.parentNode,
                            // Шаг 2 - внутри найденного элемента ищем элемент с ценой
                            e_cost = target_parent.getElementsByClassName('catalog__item-cost')[0],
                            // И берем в качестве цены текст внутри этого элемента (в данном примере в этом элементе только число - стоимость товара)
                            // И преобразуем текст в число, чтобы в дальнейшем не было трудностей с преобразованием
                            cost = parseInt(e_cost.innerText);
                        // Затем, имея все необходимые данные, добавляем товар в корзину
                        cart[goods_name] = {
                            count: 1,
                            cost: cost
                        };
                    }
                    // Обновляем сводную информацию о корзине
                    var total_count = 0, total_sum = 0;
                    // Вычисляем итоговое количество товаров в корзине и их общую сумму
                    for(k in cart) {
                        total_count += cart[k]['count'];
                        total_sum += cart[k]['count'] * cart[k]['cost'];
                    }
                    e_cart_mini.innerHTML = "Корзина (" + total_count + "шт., " + total_sum + "руб.)";
                } else if(action.value == "OpenCatalog") { // Обработка кнопок "Закрыть корзину", "Закрыть товар" и "Вернуться в каталог
                    // Т.е. - обработчик возвращения в каталог
                    // Очищаем все контейнеры: каталог, страницу товара, саму корзину
                    e_catalog.innerHTML = "";
                    e_cart.innerHTML = "";
                    e_goods.innerHTML = "";
                    // Выводим каталог
                    printCatalog(goods, e_catalog);

                }
            }
        }

    });

// Отобразить список категорий
function printCategories () {
    var ul = document.getElementsByClassName('filter__categories')[0],
        categories = getCategories ();
    for(k in categories) {
        var li = document.createElement('li');
        li.innerHTML = '<a href="#" data-action="filter" data-type="equal" data-filter="category" data-value="'
            + k + '">' + k + ' <span class="badge">' + categories[k] + '</span></a>';
        ul.appendChild(li);
    }
}
// Получить список категорий с количеством товаров
function getCategories () {
    var categories = [];
    // для каждого товара выполняем действие
    goods.forEach(function(el) {
        // Есть ли категория данного товара в массиве категорий
        if(categories[el.category] == undefined) {
            // нет: добавляем новый элемент
            // название категории => 1
            categories[el.category] = 1;
        } else {
            // да: увеличиваем значение счетчика товаров в этой категории
            categories[el.category]++;
        }
    });
    return categories;
}
// Отобразить фильтры по цене
function printCostFilter () {
    var ul = document.getElementsByClassName('filter__cost')[0];
    // Подсчет количества товарных позиций со стоимостью до 10000 включительно
    var i = 0;
    goods.forEach(function(el) {
        if(el.cost <= 10000) i++;
    });
    // Ввыод ссылок
    ul.innerHTML = '<li><a href="#" data-action="filter" data-type="less" data-filter="cost" data-value="10000">До 10000р <span class="badge">' + i + '</span></a></li>'
        + '<li><a href="#" data-action="filter" data-type="greater" data-filter="cost" data-value="10000">До 10000р <span class="badge">' + (goods.length - i) + '</span></a></li>';
}

// Отобразить каталог
function printCatalog(gds, catalog) {
    // итерирование goods - перебрать все элементы массива и для каждого выполнить действие
    for (var i in gds) {
        // формирование html-кода для товара и добавление в DOM-дерево
        var span1 = document.createElement('span'),
            span2 = document.createElement('span'),
            weight = document.createElement('span'),
            img = document.createElement('img'),
            to_cart = document.createElement('span'),
            div = document.createElement('div');
        span1.className = 'catalog__item-name';
        span2.className = 'catalog__item-cost';
        img.className = 'catalog__item-preview';
        div.className = 'catalog__item';
        weight.className = 'catalog__item-weight';
        span1.innerText = gds[i].name;
        span2.innerText = gds[i].cost;
        weight.innerText = gds[i].weight;
        img.src = "assets/images/" + gds[i].img;
        to_cart.innerHTML = " " +
            '<a href="#" data-action="add-cart" data-value="' + gds[i].name + '">+</a>';
        div.appendChild(span1)
        div.appendChild(img);
        div.appendChild(span2);
        div.appendChild(weight);
        div.appendChild(to_cart);
        catalog.appendChild(div);
    }
}

// Обработчики событий
function eventSortByCostUp(e) {
    catalog.innerHTML = "";
    goods = sort(goods, sortCostUp);
    printCatalog(goods, catalog);
}

// СЛУЖЕБНЫЕ ФУНКЦИИ
// Ядро сортировки
function sort(arr, rule) {
    for(var i =0; i < arr.length; i++ ) {
        for(j = i + 1; j < arr.length; j++) {
            if(!rule(arr[i], arr[j])) {
                var a = arr[i];
                arr[i] = arr[j];
                arr[j] = a;
            }
        }
    }
    return arr;
}
// Правила сортировок
// сортировака по возрастанию цены
function sortCostUp(a, b) {
    return a.cost < b.cost;
}
// сортировака по убыванию цены
function sortCostDown(a, b) {
    return a.cost > b.cost;
}

// сортировака по возрастанию веса
function sortWeightUp(a, b) {
    return a.weight < b.weight;
}
// сортировака по убыванию веса
function sortWeightDown(a, b) {
    return a.weight > b.weight;
}

// сортировака по возрастанию попуряности
function sortVogueUp(a, b) {
    return a.vogue < b.vogue;
}
// сортировака по убыванию попуряности
function sortVogueDown(a, b) {
    return a.vogue > b.vogue;
}

// Ядро фильтрации
// получает исходный массив arr
// фильтрует по значению поля с именем field
// сравнивает у каждого элемента массива это поле со значением value в соответствии с правилом rule
// если правило возвращает true, то элемент массива остается, иначе - отфильтровывается
// т.е. правило получает конкретное значение поля элемента массива и эталонное значение и должно вернуть
// true, если элемент надо оставить, false - если надо отфильтровать, т.е. выводить не надо
function filter(arr, field, rule, value) {
    var result = [];
    // перебор всех элементов исходного массива
    for (k in arr) {
        // если правило возвращает true для кокретного элемента массива, то добавляем
        // этот массив в результирующий массив
        if(rule(arr[k][field], value)) result.push(arr[k]);
    }
    return result;
}
// Фильтрация "больше" значения:
function is_greater(a, b) {
    return a > b;
}
// Фильтрация "меньше или равно" значению:
function is_less(a, b) {
    return a <= b;
}
// Фильтрация "равно" значения:
function is_equal(a, b) {
    return a == b;
}



// var a = [1,8,4,7,3,8,5];
// console.log(a);
// a = sort(a, compare1);
// console.log(a);







