<?php

?>

<div id='<?php echo "anchor".$this->id."a";?>' class="sortby__item">
    <span class="sortby__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="sortby__item-preview" src="assets/<?php echo $this->img; ?>" alt="">
    <span class="sortby__item-cost"><?php echo "<b>Цена: </b>". $this->cost." руб."; ?></span>
    <span class="sortby__item-weight"><?php echo "<b>Вес: </b>". ($this->weight/1000)." кг." ; ?></span>
    <span class="sortby__item-vogue"><?php echo "<b>Популярность: </b>". $this->vogue; ?></span>
    <!--<span class="sortby__item-id">--><?php //echo "<b>ID: </b>". $this->id; ?><!--</span>-->
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>">Подробнее</a>
    <a href="/index.php?q=sortby&actionsort=<?php echo $_GET['actionsort'];?>&sort_field=<?php echo $_GET['sort_field'];?>&id=<?php echo $this->id; ?>&action=addtocart&anchor=anchor<?php echo $this->id.'a' ;?>">В корзину</a>
    
</div>