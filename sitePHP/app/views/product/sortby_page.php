<?php

?>

<div class="sortby__item">
    <span class="sortby__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="sortby__item-preview" src="assets/images/<?php echo $this->img; ?>" alt="">
    <span class="sortby__item-cost"><?php echo "<b>Цена: </b>". $this->cost; ?></span>
    <span class="sortby__item-weight"><?php echo "<b>Вес: </b>". $this->weight; ?></span>
    <span class="sortby__item-vogue"><?php echo "<b>Популярность: </b>". $this->vogue; ?></span>
    <span class="sortby__item-id"><?php echo "<b>ID: </b>". $this->id; ?></span>
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>">Подробнее</a>
    <a href="/index.php?q=sortby&actionsort=<?php echo $_GET['actionsort'];?>&sort_field=<?php echo $_GET['sort_field'];?>&id=<?php echo $this->id; ?>&action=addtocart">В корзину</a>
    
</div>