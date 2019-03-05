<?php

?>

<div id='<?php echo "anchor".$this->id."a";?>' class="catalog__item">
    <span class="catalog__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="catalog__item-preview" src="assets/<?php echo $this->img; ?>" alt="">
    <span class="catalog__item-cost"><?php echo "<b>Цена: </b>". $this->cost." руб."; ?></span>
    <span class="catalog__item-weight"><?php echo "<b>Вес: </b>". ($this->weight/1000)." кг."; ?></span>
    <span class="catalog__item-vogue"><?php echo "<b>Популярность: </b>". $this->vogue; ?></span>
    <!--<span class="catalog__item-id">--><?php //echo "<b>ID: </b>". $this->id; ?><!--</span>-->
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>">Подробно</a>
    <a href="/index.php?q=catalog<?php echo'&id='.$this->id
                                            .'&weight='.$this->weight
                                            .'&cost='.$this->cost
                                            .'&action=addtocart'
                                            .'&anchor=anchor'.$this->id.'a';?>">В корзину</a>
</div>