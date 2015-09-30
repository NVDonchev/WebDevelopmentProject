<?php
class SellController extends BaseController
{
    function __construct()
    {
        parent::__construct();

        include PATH_TO_APP . DS . "models" . DS . "ProductsRepository.php";
        include PATH_TO_APP . DS . "models" . DS . "UsersRepository.php";

        $this->productsRepo = new ProductsRepository();
    }

    public function chooseProductsToSell() {
        $products = $this->usersRepo->getUserProducts();

        return new View($products);
    }
}