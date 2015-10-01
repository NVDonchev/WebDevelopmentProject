<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Shop</title>
</head>

<body>
<div class="container">
<?php if(isset($_SESSION["username"])) : ?>
    <h4>User: <a href="../../../../../<?php echo APP_DIR_NAME ?>/user/showProfile"><i><?php echo $_SESSION["username"]?></i></a></h4>

    <a href="../../../../../<?php echo APP_DIR_NAME ?>/home" class="btn btn-info">Home</a><br><br>

    <?php if($_SESSION["userRole"] === "admin") : ?>
        <a href="../../../../../<?php echo APP_DIR_NAME ?>/user/showUsersList" class="btn btn-info">Manage users</a><br><br>
    <?php endif; ?>

    <?php if($_SESSION["userRole"] === "editor") : ?>
        <a href="../../../../../<?php echo APP_DIR_NAME ?>/edit" class="btn btn-info">Go Edit</a><br><br>
    <?php endif; ?>

    <a href="../../../../../<?php echo APP_DIR_NAME ?>/cart/showCart" class="btn btn-info">View Cart</a><br><br>

    <a href="../../../../../<?php echo APP_DIR_NAME ?>/sell/chooseProductsToSell" class="btn btn-info">Sell Products</a><br><br>

    <a href="../../../../../<?php echo APP_DIR_NAME ?>/authentication/logout" class="btn btn-link">Logout</a>
    <hr>
<?php endif; ?>