<?php

class htmlRender
{
    static private $uniqueId;

    static public function beginForm($attributes) {
        $elementHtml = '<form ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';
        $elementHtml = $elementHtml . '<input type="hidden" name="my_token" id="my_token" value="' . $_SESSION['my_token'] . '" />';

        echo $elementHtml;
    }

    static public function endForm() {
        $elementHtml = '</form>';

        echo $elementHtml;
    }


    static public function beginAjaxForm($attributes) {
        if (!isset(htmlRender::$uniqueId)) {
            htmlRender::$uniqueId = md5(uniqid());
        }

        $elementHtml = '<form data-formid="' . htmlRender::$uniqueId . '"';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';

        echo $elementHtml;
    }

    static public function endAjaxForm() {
        $elementHtml = '</form>';

        $singleQuote = "'";

        $elementHtml = $elementHtml . '<script type="text/javascript" >' . "\n";

        $elementHtml = $elementHtml . '$("form[data-formId=' . $singleQuote . htmlRender::$uniqueId . $singleQuote . ']").submit(function(event) {' . "\n";
        $elementHtml = $elementHtml . 'event.preventDefault();' . "\n";

        $elementHtml = $elementHtml . 'var inputObject = "{ ";' . "\n";
        $elementHtml = $elementHtml . '$("form[data-formId=' . $singleQuote . htmlRender::$uniqueId . $singleQuote . '] input").each(function() {' . "\n";
        $elementHtml = $elementHtml . 'var nameValue = $(this).attr("name");' . "\n";
        $elementHtml = $elementHtml . 'inputObject += "\"" + nameValue + "\"" + ": " + "\"" + $("input[name=' . $singleQuote . '" + nameValue + "' . $singleQuote . ']").val() + "\"" + ", ";' . "\n";
        $elementHtml = $elementHtml . '})' . "\n";
        $elementHtml = $elementHtml . 'inputObject = inputObject.slice(0,-2)' . "\n";
        $elementHtml = $elementHtml . 'inputObject += " }";' . "\n";

        $elementHtml = $elementHtml . 'var jsonObject = jQuery.parseJSON(inputObject);' . "\n";

        $elementHtml = $elementHtml . 'var $form = $(this);' . "\n";
        $elementHtml = $elementHtml . 'var url = $form.attr( "action" );' . "\n";
        $elementHtml = $elementHtml . 'var posting = $.post( url, jsonObject );' . "\n";
        $elementHtml = $elementHtml . '})';

        $elementHtml = $elementHtml . '</script>' . "\n";

        echo $elementHtml;
    }

    static public function radioButton($attributes) {
        $elementHtml = '<input type="radio" ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';

        echo $elementHtml;
    }

    static public function checkBox($attributes) {
        $elementHtml = '<input type="hidden" name="'.$attributes["name"].'" value="off">';
        $elementHtml = $elementHtml. '<input type="checkbox" ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';

        echo $elementHtml;
    }

    static public function DropDown($selectAttributes, $optionsAttributes) {
        // open select tag
        $elementHtml = '<select ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $selectAttributes);
        $elementHtml = $elementHtml . '>';

        // generate options
        foreach ($optionsAttributes as $optionAttributes) {
            $elementHtml = $elementHtml . '<option ';
            $elementHtml = htmlRender::setAttributes($elementHtml, $optionAttributes);
            $elementHtml = $elementHtml . '>' . htmlRender::setContent($optionAttributes).'</option>';
        }

        // close select tag
        $elementHtml = $elementHtml . '</select>';

        echo $elementHtml;
    }

    static public function textField($attributes) {
        $elementHtml = '<input type="text" ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';

        echo $elementHtml;
    }

    static public function passwordField($attributes) {
        $elementHtml = '<input type="password" ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>';

        echo $elementHtml;
    }

    static public function textArea($attributes) {
        $elementHtml = '<textarea ';
        $elementHtml = htmlRender::setAttributes($elementHtml, $attributes);
        $elementHtml = $elementHtml . '>'.htmlRender::setContent($attributes).'</textarea>';

        echo $elementHtml;
    }

    static public function generateAntiForgeryToken() {
        $data['my_token'] = md5(uniqid(rand(), true));
        $_SESSION['my_token'] = $data['my_token'];
    }

    static private function setAttributes($elementHtml, $attributes) {
        foreach($attributes as $attrName => $attrValue) {
            if ($attrName !== "content")
            $elementHtml = $elementHtml . $attrName . '="' . $attrValue . '" ';
        }

        return $elementHtml;
    }

    static private function setContent($attributes) {
        if (isset($attributes["content"])) {
            return $attributes["content"];
        }

        return;
    }
}