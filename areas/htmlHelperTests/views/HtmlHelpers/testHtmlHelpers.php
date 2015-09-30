
<!-- Begin form-->
<br>
<?php htmlRender::beginForm(array("action" => "action.php", "method" => "POST", "accept-charset" => "UTF-8")) ?>

<!-- RadioButtons -->
<br>
<?php htmlRender::radioButton(array("name" => "sex", "value" => "male")) ?>Male<br>
<?php htmlRender::radioButton(array("name" => "sex", "value" => "female")) ?>Female<br>
<br>

<!-- CheckBoxes -->
<br>
<?php htmlRender::checkBox(array("name" => "vehicle", "value" => "Bike")) ?>I have a bike<br>
<?php htmlRender::checkBox(array("name" => "vehicle", "value" => "Car")) ?>I have a car<br>
<br>

<!-- DropDown -->
<br>
Select Car: <?php htmlRender::DropDown(array("class" => "testClass"), array(
    array("value" => "volvo", "content" => "Volvo"),
    array("value" => "volvo", "content" => "Saab"),
    array("value" => "mercedes", "content" => "Mercedes"),
    array("value" => "audi", "content" => "Audi", "selected" => "selected"))) ?>
<br>

<!-- TextField -->
<br>
Name: <?php htmlRender::textField(array("name" => "age", "class" => "testClass", "id" => "testId")) ?>
<br>

<!-- PasswordField -->
<br>
Password: <?php htmlRender::passwordField(array("name" => "age", "class" => "testClass", "id" => "testId")) ?>
<br>

<!-- TextArea -->
<br>
<?php htmlRender::textArea(array("content" => "Test Content", "rows" => 4, "cols" => 50)) ?>
<br>
<br>
<button type="submit">Submit</button>

<!-- EndForm -->
<?php htmlRender::endForm() ?><br>
<br>

<label>Ajax Form</label>
<br><br>
<!-- Ajax Form -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<?php

htmlRender::beginAjaxForm(array("action"=>"home/filterProductsByCategory", "method"=>"POST"));

htmlRender::textField(array("name" => "username"));
htmlRender::passwordField(array("name" => "password"));
?>
<button type="submit" value="Go" class="btn btn-success">Submit Ajax</button> <br>
<?php
htmlRender::endAjaxForm();