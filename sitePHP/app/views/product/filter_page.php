<?php
?>

<div class="filterby__item">
    <span class="filterby__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="filterby__item-preview" src="assets/images/<?php echo $this->img; ?>" alt="">
    <span class="filterby__item-cost"><?php echo "<b>Цена: </b>". $this->cost; ?></span>
    <span class="filterby__item-weight"><?php echo "<b>Вес: </b>". $this->weight; ?></span>
    <span class="filterby__item-vogue"><?php echo "<b>Популярность: </b>". $this->vogue; ?></span>
    <span class="filterby__item-id"><?php echo "<b>ID: </b>". $this->id; ?></span>
    <span class="filterby__item-category"><?php echo "<b>Категория: </b>". $this->category; ?></span>
    <a href="/index.php?q=product&id=<?php echo $this->id; ?>">Подробнее</a>
    <a href="/index.php?q=filter&datafilter=<?php echo $_GET['datafilter'];?>&filtertype=<?php echo $_GET['filtertype'];?>&filtervalue=<?php echo $_GET['filtervalue'];?>&id=<?php echo $this->id; ?>&action=addtocart">В корзину</a>
    <!--
    <a href="/index.php?q=filter&actionfilter=<?php //echo $_GET['actionfilter'];?>&datacategory=<?php //echo $_GET['datacategory'];?>&id=<?php //echo $this->id; ?>&action=addtocart">В корзину</a>
    -->
</div>