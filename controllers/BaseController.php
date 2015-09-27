<?php

abstract class BaseController {
    protected $controller;
    protected $action;
    protected $viewBag = [];
    protected $viewRendered = false;

    protected $products;
    protected $users;

    public function __construct($controller, $action) {
        $this->controller = $controller;
        $this->action = $action;
        $this->onInit();
    }

    public function loadModels($products, $users) {
        $this->products = $_SESSION["products"];
        $this->users = $_SESSION["users"];
    }

    protected function onInit() {
        // Override this function in subclasses to initialize the controller
    }

    protected function getDistrictCategories() {
        $categories = array();
        foreach ($this->products as $product) {
            $categories[] = $product->category;
        }
        $uniqueCategories = array_unique($categories);

        return $uniqueCategories;
    }

    protected function redirectToUrl($url) {
        header("Location: $url");
        die;
    }

    protected function redirect($controller = null, $action = null, $params = []) {
        if ($controller == null) {
            $controller = $this->controller;
        }
        $url = "/$controller/$action";
        $paramsUrlEncoded = array_map('urlencode', $params);
        $paramsJoined = implode('/', $paramsUrlEncoded);
        if ($paramsJoined != '') {
            $url .= '/' . $paramsJoined;
        }
        $this->redirectToUrl($url);
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    protected function isAdmin() {
        return isset($_SESSION['isAdmin']);
    }

    protected function authorize() {
        if (! $this->isLoggedIn()) {
            $this->redirect("users", "login");
        }
    }

    protected function authorizeAdmin() {
        if (! $this->isAdmin()) {
            die('Administrator account is required!');
        }
    }
}