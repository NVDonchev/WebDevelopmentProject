<?php

class CartRepository extends BaseRepository {
    public function addProduct($product) {
        array_push($_SESSION["cart"], $product);
        $this->cart = $_SESSION["cart"];
    }

    public function getCartContent() {
        return $this->cart;
    }

    public function emptyCart() {
        $_SESSION["cart"] = array();
        $this->cart = array();
    }
}