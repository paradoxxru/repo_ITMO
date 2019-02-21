<?php
?>
<div class="cart__item">
            <div class="cart__item-del">
                <a href="/index.php?q=cart&id=<?php echo $this->id; ?>&action=del_element">X</a>
            </div>
            <div class="cart__item-small_images">
                <img src="assets/<?php echo $this->img;?>">
            </div>
            <div class="cart__item-info">
                <span class="cart__item-name"><?php echo "<b>Название: </b>".$this->name; ?></span>
                <span class="cart__item-description"><?php echo "<b>Описание: </b>".$this->description; ?></span>
                <span class="cart__item-weight"><?php echo "<b>Вес: </b>".$this->weight; ?></span>
                <span class="cart__item-vogue"><?php echo "<b>Популярность: </b>".$this->vogue; ?></span>
                <span class="cart__item-id"><?php echo "<b>ID: </b>".$this->id; ?></span>
            </div>
            <div class="cart__item-cost_count">
                <span class="cart__item-cost"><?php echo "<b>Цена: </b>".$this->cost; ?></span>
                <span class="cart__item-summcost">
                	<?php //echo "<b>Стомость: </b>".($this->cost)*($_SESSION['cart'][$this->id])?>
                    <?php echo "<b>Стомость: </b>".$this->summ_cost ;?>
                </span>
                <div>
                    <a href="/index.php?q=cart<?php echo'&id='.$this->id
                                            .'&weight='.$this->weight
                                            .'&cost='.$this->cost
                                            .'&action=deltocart'?>">-</a>
                    <span><?php echo "<b>Кол-во: </b>".$this->count_in_cart ; ?></span>
                    <a href="/index.php?q=cart<?php echo'&id='.$this->id
                                            .'&weight='.$this->weight
                                            .'&cost='.$this->cost
                                            .'&action=addtocart'?>">+</a>
                </div>
            </div>
        </div>