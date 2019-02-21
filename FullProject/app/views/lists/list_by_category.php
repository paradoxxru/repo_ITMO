<?php
$cat = \app\dataio\CListsBy::$categories;
// echo "<pre>";
// echo "массив категорий: ";echo "<br>";
// var_dump($cat);
// echo "</pre>";

//datafilter - значение по которому сравнивать(категория, стоимость)
//filtervalue - значение с которым сравнивать(конкретная категория, стоимость от/до 1000)
//filtertype - тип фильтра(равно, больше, меньше)
foreach ($cat as $key => $value) {
	// echo "<li>
	// 		<a href='/index.php?q=filter&actionfilter=filter_category&datacategory="
	// 		 .$key."' data-category='".$key."'>".$key."</a>
	// 		<span class='badge'>".$cat[$key] ."</span></li>";
		echo "<li>
			<a href='/index.php?q=filter&datafilter=category&filtertype=equal&filtervalue=".$key."'>".$key."</a>
			<span class='badge'>".$cat[$key] ."</span>
			</li>";
        }
?>