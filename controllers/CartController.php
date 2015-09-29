<?php

class CartController extends BaseController {
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."ProductsRepository.php";
        include PATH_TO_APP.DS."models".DS."CartRepository.php";
        include PATH_TO_APP.DS."models".DS."UsersRepository.php";

        $this->productsRepo = new ProductsRepository();
        $this->cartRepo = new CartRepository();
        $this->usersRepo = new UsersRepository();
    }

    function addToCart(ProductIdBindingModel $model) {
        $productId = $model->productId;

        $product = $this->productsRepo->getById($productId);
        if ($product->quantity > 0) {
            $product->quantity--;
        }
        else {
            die("Cannot add to cart this product.");
        }

        $this->productsRepo->editProduct($productId, $product);
        $this->cartRepo->addProduct($product);

        $this->redirectToUrl("../home");
    }

    function showCart() {
        $products = $this->cartRepo->getCartContent();

        return new View($products);
    }

    function checkout() {
        $products = $this->cartRepo->getCartContent();

        $price = 0;
        foreach($products as $product) {
            $price += $product->price;
        }

        $viewModel = new CheckoutViewModel();
        $viewModel->products = $products;
        $viewModel->totalPrice = $price;

        return new View($viewModel);
    }

    function emptyCart() {
        $this->cartRepo->emptyCart();

        $this->redirectToUrl("../home");
    }

    function buyProducts() {
        $products = $this->cartRepo->getCartContent();

        $price = 0;
        foreach($products as $product) {
            $price += $product->price;
        }

        $this->usersRepo->takeMoneyFromCurrentUser($price);
        $this->cartRepo->emptyCart();

        return new View(null, "transactionSuccessful");
    }
}