<?php

?>

<div class="goods__item">
    <span class="goods__item-name">
    	<?php
    	 echo "<b>Название: </b>". $this->name;
    	?>
	</span>
    <img class="goods__item-preview" src="assets/images/<?php echo $this->img; ?>" alt="">
    <span class="goods__item-cost"><?php echo "<b>Цена: </b>". $this->cost; ?></span>
    <span class="goods__item-weight"><?php echo "<b>Вес: </b>". $this->weight; ?></span>
    <span class="goods__item-description"><?php echo "<b>Описание: </b>". $this->description; ?></span>
    <span class="goods__item-vogue"><?php echo "<b>Популярность: </b>". $this->vogue; ?></span>
    <span class="goods__item-category"><?php echo "<b>Категория: </b>". $this->category; ?></span>
    <span class="goods__item-count"><?php echo "<b>Количество: </b>". $this->count; ?></span>
    <span class="goods__item-id"><?php echo "<b>ID: </b>". $this->id; ?></span>
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>&action=addtocart">В корзину</a>
    <a href="/index.php?q=catalog">Назад в каталог</a>
</div>