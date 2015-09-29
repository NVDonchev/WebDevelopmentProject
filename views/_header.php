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
    <h4>User: <i><?php echo $_SESSION["username"]?></i></h4>
    <a href="authentication/logout">Logout</a>
    <hr>
<?php endif; ?>