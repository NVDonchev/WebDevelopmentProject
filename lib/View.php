<?php

class View
{
    public $model;
    public $viewName;

    function __construct($model = null, $viewName = null) {
        $this->model = $model;

        if (isset($viewName)) {
            $this->viewName = $viewName;
        }
    }

    public function render($viewPath) {
        $model = $this->model;

        include $viewPath;
    }

    public function htmlSpecialCharsConditional($text, $isEscaping = true) {
        if ($isEscaping) {
            return htmlspecialchars($text);
        }

        return $text;
    }
}