<?php

class User  {
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $cash;
    public $role;
    public $products;

    function __construct($username, $password, $cash, $role, $firstName, $lastName) {
        $this->username = $username;
        $this->password = $password;
        $this->cash = $cash;
        $this->role = $role;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}