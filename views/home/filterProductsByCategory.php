
<!-- Model: Models/Product -->

<?php include PATH_TO_APP . "views/_header.php"; ?>

<a href="../cart/showCart" class="btn btn-info">View Cart</a><br><br>

<h3>Filtered Products</h3>

<?php
$categoriesArray = array();
foreach($model->categories as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"filterProductsByCategory", "method"=>"POST"));
htmlRender::DropDown(array("name"=>"category"), $categoriesArray);
?>
&nbsp;<input type="submit" value="Filter" class="btn btn-default"><br>
<?php htmlRender::checkBox(array("name"=>"getOnlyAvailable"));?> <label>Available only</label><br>
<a href="../home">List All</a>
<?php htmlRender::endForm(); ?>

<br>

<?php htmlRender::beginForm(array("action"=>"../cart/addToCart", "method"=>"POST")); ?>
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
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><?php echo $product->category; ?></td>
            <td><?php echo $product->quantity; ?></td>
            <td><?php htmlRender::radioButton(array("name" => "productId", "value" => $product->id))?></td>
        </tr>
    <?php endforeach; ?>
</table>
<input type="submit" value="Add to Cart" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>

<?php include PATH_TO_APP . "views/_footer.php"; ?>