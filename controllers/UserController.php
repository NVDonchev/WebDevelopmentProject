<?php

class UserController extends BaseController
{
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."UsersRepository.php";

        $this->usersRepo = new UsersRepository();
    }

    function showProfile() {

        return new View();
    }
}