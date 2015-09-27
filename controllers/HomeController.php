<?php 

class HomeController extends BaseController {
    function __construct() {
    }

	public function index()
	{
        if ($this->isLoggedIn()) {
            return new View($this->products);
        }
        else {
            $uniqueCategories = $this->getDistrictCategories();
            return new View(array("products" => $this->products, "categories" => $uniqueCategories));
        }
	}

    public function filterProductsByCategory(FilterByCategoryBindingModel $model)
    {
        $filteredProducts = array();
        foreach($this->products as $product) {
            if ($product->category === $model->category)
            array_push($filteredProducts, $product);
        }

        $uniqueCategories = $this->getDistrictCategories();
        return new View(array("products" => $filteredProducts, "categories" => $uniqueCategories));
    }

    public function buyProduct(BuyProductBindingModel $model) {
        $productId = $model->productId;

        foreach ($this->products as $index => $product) {
            if ($product->id == $productId && $product->quantity > 0) {
                $this->products[$index]->quantity--;

                header('Location: ../home');
            }
        }

        die("Cannot buy this product.");
    }
}

?>