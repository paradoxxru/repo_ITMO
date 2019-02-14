<?php

?>

<div class="catalog__item">
    <span class="catalog__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="catalog__item-preview" src="assets/images/<?php echo $this->img; ?>" alt="">
    <span class="catalog__item-cost"><?php echo "<b>Цена: </b>". $this->cost; ?></span>
    <span class="catalog__item-id"><?php echo "<b>ID: </b>". $this->id; ?></span>
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>">Подробнее</a>
    <a href="/index.php?q=catalog&id=<?php echo $this->id; ?>&action=addtocart">В корзину</a>
    
</div>