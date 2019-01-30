<?php

?>

<div class="catalog__item">
    <span class="catalog__item-name">
    	<?php
    	 echo $this->name;
    	?>
	</span>
    <img class="catalog__item-preview" src="assets/images/<?php echo $this->img; ?>" alt="">
    <span class="catalog__item-cost"><?php echo $this->cost; ?></span>
    <a href="/lessonsPHP-master/public/index.php?q=product&id=<?php echo $this->id; ?>">Подробнее</a>
</div>