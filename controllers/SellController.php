<?php
class SellController extends BaseController
{
    function __construct()
    {
        parent::__construct();

        include PATH_TO_APP . DS . "models" . DS . "ProductsRepository.php";
        include PATH_TO_APP . DS . "models" . DS . "UsersRepository.php";

        $this->productsRepo = new ProductsRepository();
        $this->usersRepo = new UsersRepository();
    }

    public function chooseProductsToSell() {
        $products = $this->usersRepo->getUserProducts();
        $userCash = $this->usersRepo->getCurrentUser()->cash;

        $viewModel = new chooseProductsToSellViewModel();
        $viewModel->products = $products;
        $viewModel->userCash = $userCash;

        return new View($viewModel);
    }

    public function sellProduct(ProductIdBindingModel $model) {
        $productId = $model->productId;

        $products = $this->usersRepo->getUserProducts();

        $price = 0;
        foreach ($products as $product) {
            if ($product->id == $productId) {
                if($product->quantity > 1) {
                    $product->quantity--;
                    $this->productsRepo->editProduct($productId, $product);
                    $price = $product->price;
                    $this->usersRepo->giveMoneyToCurrentUser($price);
                }
                else {
                    $this->usersRepo->removeUserProduct($productId);
                    $price = $product->price;
                    $this->usersRepo->giveMoneyToCurrentUser($price);
                }
            }
        }

        return new View($price);
    }
}