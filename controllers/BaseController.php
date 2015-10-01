<?php

abstract class BaseController {
    protected $controller;
    protected $action;
    protected $viewBag = [];
    protected $viewRendered = false;

    protected $productsRepo;
    protected $usersRepo;

    public function __construct() {
        include PATH_TO_APP.DS."models".DS."BaseRepository.php";
    }

    protected function redirectToUrl($url) {
        header("Location: $url");
        die;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    protected function isAdmin() {
        if (isset($_SESSION['userRole'])) {
            return ($_SESSION['userRole'] === "admin");
        }
    }

    protected function isEditor() {
        if (isset($_SESSION['userRole'])) {
            return ($_SESSION['userRole'] === "editor");
        }
    }

    protected function validateAntiForgeryToken() {
        if ($_POST['my_token'] !== $_SESSION['my_token'])
        {
            die("Anti-forgery token can't be validated.");
        }
    }
}