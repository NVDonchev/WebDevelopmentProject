
<!-- Model: Models/Product -->

<?php include PATH_TO_APP . "views/_header.php"; ?>

<h3>Products Catalog</h3>

<?php
$categoriesArray = array();
foreach($model["categories"] as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"home/filterProductsByCategory", "method"=>"POST"));
htmlRender::DropDown(array("name"=>"category"), $categoriesArray);
?>
<input type="submit" value="Filter"><br>
<?php htmlRender::endForm(); ?>

<br>
<br>

<?php htmlRender::beginForm(array("action"=>"home/buyProduct", "method"=>"POST")); ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Buy</th>
    </tr>
    <?php foreach( $model["products"] as $product ) :?>
        <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><?php echo $product->category; ?></td>
            <td><?php echo $product->quantity; ?></td>
            <td><?php htmlRender::radioButton(array("name" => "productId", "value" => $product->id))?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<input type="submit" value="Buy Selected"><br>
<?php htmlRender::endForm(); ?>

<?php include PATH_TO_APP . "views/_footer.php"; ?>