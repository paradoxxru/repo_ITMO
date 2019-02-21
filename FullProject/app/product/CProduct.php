<?php
namespace app\product;

class CProduct  //был abstract 
{
    private $weight = 0;
    private $cost = 0;
    private $name = "";
    private $description = "";
    private $vogue = 0;
    private $category = "";
    private $count = 0;
    private $img = "";
    private $id = 0;
    private $receipt_data = "";
    private $count_in_cart = 0;
    private $summ_cost = 0;


    // public function fillRandom() {
    //     $this->weight = rand(1,2) > 1
    //         ? rand(1, 20)/10
    //         : rand(1, 20);
    //     $this->cost = rand(1,2) > 1
    //         ? rand(1, 20) * 100
    //         : rand(1, 20) * 1000;
    //     $this->vogue = rand(1,100);
    //     $this->count = rand(1, 50);
    //     $this->category = WordGenerator::randomCategory();
    //     $this->name = WordGenerator::randomSentence(rand(2,4), WordGenerator::UL);
    //     $this->description = WordGenerator::randomText(rand(4, 10), WordGenerator::ULP);
    //     $this->img = "im" . rand(1, 6) . ".svg";
    // }
    // public function __construct($id = false)
    // {
    //     if($id !== false) {
    //         if($id === "random") {
    //             $this->fillRandom();
    //         } else {
    //             $this->name = '';
    //             $this->weight = 0;
    //             $this->count = 0;
    //             $this->cost = 0;
    //             $this->description = '';
    //             $this->vogue = 0;
    //             $this->category = '';
    //             $this->img = '';
    //             $this->id = $id;
    //         }
    //     }
    // }

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
            if(property_exists($this, $key)) 
                $this->$key = $val;
        }
    }
}