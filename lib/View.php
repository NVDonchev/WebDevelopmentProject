<?php

class View
{
    public $model;
    public $viewName;

    function __construct($model, $viewName = null) {
        $this->model = $model;

        if (isset($viewName)) {
            $this->viewName = $viewName;
        }
    }

    public function render($view) {
        $model = $this->model;

        include PATH_TO_APP."views".DS.$view;
    }
}