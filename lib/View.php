<?php

class View
{
    private $model;

    function __construct($model) {
        $this->model = $model;
    }

    public function render($view) {
        $model = $this->model;

        include PATH_TO_APP."views".DS.$view;
    }
}