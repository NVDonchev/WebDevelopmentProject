
<?php include PATH_TO_APP . "views/_header.php"; ?>

<?php if(count($model) > 0) : ?>

<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
    </tr>
    <?php foreach( $model as $product ) :?>
        <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->price; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="checkout" class="btn btn-success">Proceed to Checkout</a>
<br>
<br>
<a href="emptyCart" class="btn btn-danger">Empty the cart</a>

<?php else : ?>
    <h3>No products in the cart</h3>
<?php endif; ?>

<?php include PATH_TO_APP . "views/_footer.php"; ?>