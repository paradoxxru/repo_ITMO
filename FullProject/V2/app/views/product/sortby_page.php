<?php

?>

<div class="<?php echo $this->class_sortby_item ;?>">
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
    <a class="<?php echo $this->class_for_a ;?>" data-action="addtocart" 
        href="/index.php?q=catalog<?php echo'&id='.$this->id
                                            .'&weight='.$this->weight
                                            .'&cost='.$this->cost
                                            .'&action=addtocart';?>">В корзину</a>
    
</div>