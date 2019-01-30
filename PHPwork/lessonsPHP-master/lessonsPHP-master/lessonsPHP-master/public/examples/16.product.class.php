<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 27.12.2018
 * Time: 21:36
 */

class Product {
    public $weight = 0;
    public $cost = 0;
    public $name;
    public $description;
    public $vogue;
    public $category;
    public $count;

    public $arr = [
        'weight' => 100,
        'cost' => 200
    ];
    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getVogue()
    {
        return $this->vogue;
    }

    /**
     * @param mixed $vogue
     */
    public function setVogue($vogue): void
    {
        $this->vogue = $vogue;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count): void
    {
        $this->count = $count;
    }
    public function __construct($name = false)
    {
        if($name) $this->name = $name;
        $this->cost = 0;
    }
    public function getWeight() {
        return $this->weight;
    }
    public function setWeight($new_weight) {
        $this->weight = $new_weight;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "Продукт: "
            . $this->name
            . " (" . $this->count . "): "
            . $this->arr['cost'][0];
    }

    /**
     *
     */
    public function render() {
        include ("examples/view/product.php");
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
        $this->name = "Клон " . $this->name;
    }
}

class ProductCar extends Product {
    public $vendor;
    public $power;
    public $color;
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "Автомобиль: " . $this->name . " (" . $this->count . ")";
    }
}

class ProductPC extends Product {
    public $cpu;
    public $ram;
    public $hdd;
}



