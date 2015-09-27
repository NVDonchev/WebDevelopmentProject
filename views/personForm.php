<!DOCTYPE HTML>
<html>
<body>

<form action="home" method="post">
    Name: <input type="text" name="name"><br>
    Age: <input type="text" name="age"><br>
    IsHungry: <input type="text" name="hungry"><br>

    <input type="submit">
</form>

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

<!-- EndForm -->
    <?php htmlRender::endForm() ?><br>
<br>

</body>
</html>

<?php
