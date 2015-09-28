<?php 

class HomeController extends BaseController {
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."ProductsRepository.php";

        $this->productsRepo = new ProductsRepository();
    }

	public function index()
	{
        $allProducts = $this->productsRepo->getAll();

        if (!$this->isLoggedIn()) {
            $this->redirectToUrl("authentication");
        }

        $uniqueCategories = $this->productsRepo->getCategoryNames();
        return new View(array("products" => $allProducts, "categories" => $uniqueCategories));
	}

    public function filterProductsByCategory(FilterByCategoryBindingModel $model)
    {
        $productsByCategory = $this->productsRepo->getByCategory($model->category);
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        return new View(array("products" => $productsByCategory, "categories" => $uniqueCategories));
    }

    public function buyProduct(BuyProductBindingModel $model) {
        $productId = $model->productId;

        $productToEdit = $this->productsRepo->getById($productId);
        if ($productToEdit->quantity > 0) {
            $productToEdit->quantity--;
        }
        else {
            die("Cannot buy this product.");
        }

        $this->productsRepo->editProduct($productId, $productToEdit);

        $this->redirectToUrl("../home");
    }
}

?>