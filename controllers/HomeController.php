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

        $viewModel = new ListProductsViewModel();
        $viewModel->products = $allProducts;
        $viewModel->categories = $uniqueCategories;

        return new View($viewModel);
	}

    public function filterProductsByCategory(FilterByCategoryBindingModel $model)
    {
        $productsByCategory = $this->productsRepo->getByCategory($model->category, $model->getOnlyAvailable);
        $uniqueCategories = $this->productsRepo->getCategoryNames();

        $viewModel = new ListProductsViewModel();
        $viewModel->products = $productsByCategory;
        $viewModel->categories = $uniqueCategories;

        return new View($viewModel);
    }
}

?>