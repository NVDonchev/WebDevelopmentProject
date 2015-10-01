
<?php include PATH_TO_APP . "views/_header.php"; ?>

<?php if(count($model->products) > 0) : ?>
<?php htmlRender::beginForm(array("action"=>"sellProduct", "method"=>"POST")); ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Select</th>
    </tr>
    <?php foreach( $model->products as $product ) :?>
        <tr>
            <td><?php echo $this->htmlSpecialCharsConditional($product->name, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->price, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->category); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->quantity); ?></td>
            <td><?php htmlRender::radioButton(array("name" => "productId", "value" => $product->id))?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<input type="submit" value="Sell Product" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>

<?php else : ?>
    <h3>You have no products for selling</h3>
<?php endif; ?>

<br>
<label>Cash: <?php echo $model->userCash ?></label>

<?php include PATH_TO_APP . "views/_footer.php"; ?>