<?php

class UserController extends BaseController
{
    function __construct() {
        parent::__construct();

        include PATH_TO_APP.DS."models".DS."UsersRepository.php";

        $this->usersRepo = new UsersRepository();
    }

    function showProfile() {
        $user = $this->usersRepo->getCurrentUser();

        return new View($user);
    }

    function showUsersList() {
        $users = $this->usersRepo->getAll();

        return new View($users);
    }

    function changeUserRole(ManageUserBindingModel $model) {
        $username = $model->username;

        $user = $this->usersRepo->getUser($username);
        if ($user->role === "editor") {
            $role = "user";
            $this->usersRepo->editUserRole($username, $role);
        }
        else if ($user->role === "user") {
            $role = "editor";
            $this->usersRepo->editUserRole($username, $role);
        }

        return new View();
    }
}