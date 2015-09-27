
<!-- Model: Models/Product -->

<?php include PATH_TO_APP . "views/_header.php"; ?>

<h3>Filtered Products</h3>

<?php
$categoriesArray = array();
foreach($model["categories"] as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"filterProductsByCategory", "method"=>"POST"));
htmlRender::DropDown(array("name"=>"category"), $categoriesArray);
?>
<input type="submit" value="Filter"><br>
<a href="../home">List All</a>
<?php htmlRender::endForm(); ?>

<br>

<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Quantity</th>
    </tr>
    <?php foreach( $model["products"] as $product ) :?>
        <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><?php echo $product->category; ?></td>
            <td><?php echo $product->quantity; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include PATH_TO_APP . "views/_footer.php"; ?>