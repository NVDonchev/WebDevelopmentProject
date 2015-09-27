<?php

class User  {
    public $username;
    public $password;
    public $cash;
    public $role;

    function __construct($username, $password, $cash, $role) {
        $this->username = $username;
        $this->password = $password;
        $this->cash = $cash;
        $this->role = $role;
    }
}