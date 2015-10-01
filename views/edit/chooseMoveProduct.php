
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php

$categoriesArray = array();
foreach($model->categories as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"chooseCategoryOfProduct", "method"=>"POST")); ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Select Product</th>
    </tr>
    <?php foreach( $model->products as $product ) :?>
        <tr>
            <td><?php echo $this->htmlSpecialCharsConditional($product->name, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->price, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->quantity); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($product->category); ?></td>
            <td><?php htmlRender::radioButton(array("name" => "productId", "value" => $product->id))?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<input type="submit" value="Select Product to Move to new Category" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>