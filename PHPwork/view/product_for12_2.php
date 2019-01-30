<?php
// правило вывода информации о товаре на страницу
?>
<!--
<div>
	<span><?php /*echo $product->getName();*/ ?></span>
	<span><?php /*echo $product->getCost();*/?></span>
</div>
-->

<div>
	<!-- $a instanceof MyClass - определяем, является ли текущий объект экземпляром указанного класс. 
	Если объект принадлежит классу, который является потомком другого класса, то $a instanceof MyClass и $a instanceof inheritanceClass будут давать true, поэтому сначала проверяем на принадлежность к классу потомку-->
	<h3><?php 
			if($this instanceof ProductPC) {
				echo "Продукт класса ProductPC";
			} else if($this instanceof ProductCar) {
				echo "Продукт класса ProductCar";
			} else if($this instanceof Product) {
				echo "Продукт класса Product";
			}	
		?>	
	</h3>
	<span><?php echo $this->name; ?></span><br>
	<span><?php echo "Цена: ".$this->cost; ?></span><br>
	<span><?php echo $this->category; ?></span><br>
	<!-- $a instanceof MyClass - определяем, является ли текущий объект экземпляром указанного класс -->
	<?php if($this instanceof ProductPC) echo "<span>".$this->getCpu()."</span><br>"?>
	<?php if($this instanceof ProductPC) echo "<span>".$this->getRam()."</span><br>"?>
	<?php if($this instanceof ProductCar) echo "<span>".$this->getVendor()."</span><br>"?>
	<?php if($this instanceof ProductCar) echo "<span>".$this->getColor()."</span><br>"?>
	<span><?php echo $this->description; ?></span>
</div>