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
                $_SESSION["userRole"] = $user->role;

                return true;
            }
        }

        return false;
    }

    public function getAll() {
        return $this->users;
    }

    public function takeMoneyFromCurrentUser($amount) {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username == $username) {
                $this->users[$index]->cash -= $amount;
                $_SESSION["users"][$index]->cash -= $amount;
            }
        }
    }

    public function giveMoneyToCurrentUser($amount) {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username == $username) {
                $this->users[$index]->cash += $amount;
            }
        }
    }

    public function getCurrentUser() {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username == $username) {
                return $user;
            }
        }
    }

    public function getUser($username) {
        foreach ($this->users as $index => $user) {
            if ($user->username === $username) {
                return $user;
            }
        }
    }

    public function editUserRole($username, $role) {
        foreach ($this->users as $index => $user) {
            if ($user->username === $username) {
                $this->users[$index]->role = $role;
                return;
            }
        }
    }

    public function setUserProducts($products) {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username === $username) {
                if (isset($this->users[$index]->products)) {
                    $this->users[$index]->products = array_merge($this->users[$index]->products, $products);
                }
                else {
                    $this->users[$index]->products = $products;
                }

                return;
            }
        }
    }

    public function getUserProducts() {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username == $username) {
                return $user->products;
            }
        }
    }

    public function removeUserProduct($productId) {
        $username = $_SESSION["username"];

        foreach ($this->users as $index => $user) {
            if ($user->username == $username) {
                foreach ($user->products as $index => $product) {
                    if ($product->id == $productId) {
                        unset($user->products[$index]);
                    }
                }
            }
        }
    }
}