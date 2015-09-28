<?php

class UsersRepository extends BaseRepository
{
    public function registerUser($user) {
        array_push($_SESSION["users"], new User($user->username, $user->password, $user->cash, $user->role, $user->firstName, $user->lastName));
        $this->users = $_SESSION["users"];
    }

    public function LoginUser($username, $password) {
        foreach ($this->users as $user) {
            if ($user->username === $username && $user->password === $password) {
                $_SESSION["username"] = $username;
                $_SESSION["isAdmin"] = ($user->role === "admin");

                return true;
            }
        }

        return false;
    }
}