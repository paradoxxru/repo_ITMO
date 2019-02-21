<div class="filter flex-column">
	<b>Фильрация :</b>
	<p>По категории</p>
    <ul class="filter__categories">
    <?php
        //вызвать getListCategory($goods) - формируем массив категорий
		\app\dataio\CListsBy::getListCategory($arr_goods);
		//подключить шаблон вывода списка по категориям
		$path_to_template = "../app/views/lists/list_by_category.php"; //определили куда выводить
		include($path_to_template); // выводим
    ?>
    </ul>
    <p>По стоимости</p>
    <?php
		\app\dataio\CListsBy::getListCost($arr_goods); //считаем кол-во товара до 10000тр и от 10000тр
	?>
    <ul class="filter__cost">
        <li>
			<a href="/index.php?q=filter&datafilter=cost&filtertype=less&filtervalue=10000" data-price="less-10000">До 10 000р</a>
			<span class="badge"><?php echo \app\dataio\ClistsBy::$count_cost_less;?></span>
		</li>
		<li>
			<a href="/index.php?q=filter&datafilter=cost&filtertype=more&filtervalue=10000" data-price="more-10000">От 10 000р</a>
			<span class="badge"><?php echo \app\dataio\ClistsBy::$count_cost_more;?></span>
		</li>
    </ul>
    <p><a href="/index.php?q=catalog">Показать все товары</a></p>
</div>