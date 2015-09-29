<?php

class AuthenticationController extends BaseController
{
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."UsersRepository.php";

        $this->usersRepo = new UsersRepository();
    }

    public function index() {
        return new View(null);
    }

    public function login(LoginBindingModel $model) {
        $this->validateAntiForgeryToken();

        $loginSuccessful = $this->usersRepo->loginUser($model->username, $model->password);
        if ($loginSuccessful) {
            $this->redirectToUrl("../home");
        }
        else {
            die("Login failed");
        }
    }

    public function register(RegisterBindingModel $model) {
        $this->validateAntiForgeryToken();

        // check if passwords match
        if (!$model->password === $model->confirmPassword) {
            die("Password and Confirm Password must match.");
        }

        // check admin password
        $role = ($model->adminPassword === ADMIN_PASS ? "admin" : "user");
        $cash = INITIAL_CASH;

        // add user to db
        $user = new User($model->username, $model->password, $cash, $role, $model->firstName, $model->lastName);
        $this->usersRepo->registerUser($user);

        // login user
        $loginSuccessful = $this->usersRepo->loginUser($model->username, $model->password);

        if ($loginSuccessful) {
            $this->redirectToUrl("../home");
        }
        else {
            die("Login failed");
        }
    }

    public function logout() {
        unset($_SESSION["username"]);
        unset($_SESSION["isAdmin"]);

        $this->redirectToUrl("../authentication");
    }
}