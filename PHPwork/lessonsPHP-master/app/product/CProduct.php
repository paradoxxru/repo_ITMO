<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.01.2019
 * Time: 19:35
 */
require_once ("../app/product/WordGenerator.php");
abstract class CProduct
{
    private $weight = 0;
    private $cost = 0;
    private $name;
    private $description;
    private $vogue;
    private $category;
    private $count;
    private $img;
    private $id;


    public function fillRandom() {
        $this->weight = rand(1,2) > 1
            ? rand(1, 20)/10
            : rand(1, 20);
        $this->cost = rand(1,2) > 1
            ? rand(1, 20) * 100
            : rand(1, 20) * 1000;
        $this->vogue = rand(1,100);
        $this->count = rand(1, 50);
        $this->category = WordGenerator::randomCategory();
        $this->name = WordGenerator::randomSentence(rand(2,4), WordGenerator::UL);
        $this->description = WordGenerator::randomText(rand(4, 10), WordGenerator::ULP);
        $this->img = "im" . rand(1, 6) . ".svg";
    }
    public function __construct($id = false)
    {
        if($id !== false) {
            if($id === "random") {
                $this->fillRandom();
            } else {
                $this->name = '';
                $this->weight = 0;
                $this->count = 0;
                $this->cost = 0;
                $this->description = '';
                $this->vogue = 0;
                $this->category = '';
                $this->img = '';
                $this->id = $id;
            }
        }
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->$name ?? false;
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        if(isset($this->$name))
        {
            $this->name = $value;
            return true;
        }
        return false;
    }

//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return $this->name;
//    }

    /**
     *
     */
    public function render($view) { //принимать параметр(какое представление взять)
        //$view= catalog
        //$view= cart
        //$view= product_page
        $path_to_view = "../app/views/"
        ."/product/"
        .$view. ".php";
        include ($path_to_view);
    }
    public function toArray()
    {
        $res = [];
        foreach($this as $key => $val) {
            $res[$key] = $val;
        }
        return $res;
    }
    public function fromArray($arr)
    {
        foreach($arr as $key => $val)
        {
            if(property_exists($this, $key)) $this->$key = $val;
//            $this->$key = $val;
        }
    }
}