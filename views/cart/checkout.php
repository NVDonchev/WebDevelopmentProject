
<?php include PATH_TO_APP . "views/_header.php"; ?>
<a href="home" class="btn btn-info">HOME</a><br><br>

<h3>Are you sure you want to buy these products?</h3>

<ul>
    <?php foreach( $model->products as $product ) :?>
        <li><?php echo $product->name; ?></li>
    <?php endforeach; ?>
    <br>
    <label>Total Price: <?php echo $model->totalPrice ?></label>
</ul>
<br>
<br>

<a href="buyProducts" class="btn btn-success">Buy</a>
<a href="showCart" class="btn btn-danger">Go Back</a>

<?php include PATH_TO_APP . "views/_footer.php"; ?>