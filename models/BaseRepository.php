<?php

abstract class BaseRepository
{
    protected $products;
    protected $users;
    protected $cart;

    function __construct() {
        if (!isset($_SESSION["products"])) {
            $_SESSION["products"] = array(
                new Product(1, "Microwave", 110, "kitchen", 5),
                new Product(2, "Toaster", 340, "kitchen", 5),
                new Product(3, "Refrigerator", 700, "electronics", 3),
                new Product(4, "Washing Machine", 340, "kitchen", 5),
                new Product(5, "Sofa", 160, "furniture", 1),
                new Product(6, "Television", 1200, "electronics", 7),
                new Product(7, "Chair", 20, "furniture", 0),
                new Product(8, "Oven", 130, "kitchen", 5),
                new Product(9, "PlayStation 4", 800, "electronics", 3),
                new Product(10, "Bed", 300, "furniture", 2),
                new Product(11, "Baked Potato", 1, "food", 3),
                new Product(12, "Table", 39, "furniture", 0),
                new Product(13, "Speakers", 30, "electronics", 12),
                new Product(14, "Pizza", 15, "food", 6),
                new Product(15, "Eggs", 8, "food", 0),
                new Product(16, "Lasagna", 12, "food", 13),
                new Product(17, "Digital Camera", 550, "electronics", 1),
                new Product(18, "Laptop N3580", 340, "electronics", 5),
                new Product(19, "Headphones", 120, "electronics", 3),
                new Product(20, "Laptop J1020", 690, "electronics", 5));
        }
        $this->products = $_SESSION["products"];

        if (!isset($_SESSION["users"])) {
            $_SESSION["users"] = array();
        }
        $this->users = $_SESSION["users"];

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        $this->cart = $_SESSION["cart"];
    }
}