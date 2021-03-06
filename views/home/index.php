<!-- Model: ViewModels/ListProductsViewModel -->

<?php include PATH_TO_APP . "views/_header.php"; ?>

<h3>Products Catalog</h3>

<?php
$categoriesArray = array();
foreach($model->categories as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"home/filterProductsByCategory", "method"=>"POST"));
htmlRender::DropDown(array("name"=>"category"), $categoriesArray);
?>
&nbsp;<input type="submit" value="Filter" class="btn btn-default"><br>
<?php htmlRender::checkBox(array("name"=>"getOnlyAvailable"));?> <label>Available only</label>
<?php htmlRender::endForm(); ?>

<br>
<br>

<?php htmlRender::beginForm(array("action"=>"cart/addToCart", "method"=>"POST")); ?>
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
<input type="submit" value="Add to Cart" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>