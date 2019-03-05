<?php
namespace app\product;

class CProduct 
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
    private $class = '';
    private $in_stok = '';
    private $order_date = '';


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