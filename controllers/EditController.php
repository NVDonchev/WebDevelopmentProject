<?php

class EditController extends BaseController
{
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."ProductsRepository.php";

        $this->productsRepo = new ProductsRepository();
    }


    function index() {
        return new View();
    }

    function addProduct(AddProductBindingModel $model) {
        $product = new Product(0, $model->name, $model->price, $model->category, 1);

        $this->productsRepo->addProduct($product);

        return new View();
    }

    function deleteProduct(ProductIdBindingModel $model) {
        $productId = $model->productId;

        $this->productsRepo->deleteProduct($productId);

        return new View();
    }

    // This scenario can't work in current design of categories
    function addCategory(AddCategoryBindingModel $model) {
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        array_push($uniqueCategories, strtolower($model->name));

        return new View();
    }

    // This scenario can't work in current design of categories
    function deleteCategory(DeleteCategoryBindingModel $model) {
        $categoryName = strtolower($model->category);

        $products = $this->productsRepo->getAll();

        foreach($products as $product) {
            if ($product->category == $categoryName) {
                $newProduct = new Product($product->id, $product->name, $product->price, "default", $product->quantity);

                $this->productsRepo->editProduct($product->id, $newProduct);
            }
        }

        $categories = $this->productsRepo->getCategoryNames();

        return new View();
    }

    function moveProductToCategory(MoveToCategoryBindingModel $model) {
        $categoryName = strtolower($model->category);
        $productId = $model->productId;

        $products = $this->productsRepo->getAll();

        foreach($products as $product) {
            if ($product->id == $productId) {
                $newProduct = new Product($product->id, $product->name, $product->price, $categoryName, $product->quantity);

                $this->productsRepo->editProduct($product->id, $newProduct);
            }
        }

        $categories = $this->productsRepo->getCategoryNames();

        return new View();
    }

    function changeQuantityOfProduct(ProductIdBindingModel $model) {
        $productId = $model->productId;

        $product = $this->productsRepo->getById($productId);

        return new View($product);
    }

    function quantityChanged(QuantityChangedBindingModel $model) {
        $productId = $model->productId;
        $quantity = $model->quantity;

        $products = $this->productsRepo->getAll();

        foreach($products as $product) {
            if ($product->id == $productId) {
                $newProduct = new Product($product->id, $product->name, $product->price, $product->category, $quantity);

                $this->productsRepo->editProduct($product->id, $newProduct);
            }
        }

        return new View();
    }

    function chooseProductToAdd() {
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        return new View($uniqueCategories);
    }

    function chooseProductToDelete() {
        $products = $this->productsRepo->getAll();

        return new View($products);
    }

    function chooseCategoryToAdd() {
        return new View();
    }

    function chooseCategoryToDelete() {
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        return new View($uniqueCategories);
    }

    function chooseQuantityChange() {
        return new View();
    }

    function chooseMoveProduct() {
        $uniqueCategories = $this->productsRepo->getCategoryNames();
        $products = $this->productsRepo->getAll();

        $viewModel = new ChooseProductToMoveToCategoryViewModel();
        $viewModel->categories = $uniqueCategories;
        $viewModel->products = $products;

        return new View($viewModel);
    }

    function chooseCategoryOfProduct(ProductIdBindingModel $model) {
        $productId = $model->productId;

        $product = $this->productsRepo->getById($productId);
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        $viewModel = new MoveProductToCategoryViewModel();
        $viewModel->product = $product;
        $viewModel->categories = $uniqueCategories;

        return new View($viewModel);
    }

    function chooseProductToChangeQuantity() {
        $products = $this->productsRepo->getAll();

        return new View($products);
    }
}