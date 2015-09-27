<?php

class Product {
    public $id;
    public $name;
    public $price;
    public $category;
    public $quantity;

    function __construct($id, $name, $price, $category, $quantity) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->quantity = $quantity;
    }
}