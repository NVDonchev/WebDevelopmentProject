
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php

$categoriesArray = array();
    foreach($model->categories as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"moveProductToCategory", "method"=>"POST"));
?>

<input type=hidden name="productId" value="<?php echo  $model->product->id ?>">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Select New Category</th>
    </tr>
    <tr>
        <td><?php echo $this->htmlSpecialCharsConditional($model->product->name, false); ?></td>
        <td><?php echo $this->htmlSpecialCharsConditional($model->product->price, false); ?></td>
        <td><?php echo $this->htmlSpecialCharsConditional($model->product->quantity); ?></td>
        <td><?php echo $this->htmlSpecialCharsConditional($model->product->category); ?></td>
        <td><?php htmlRender::DropDown(array("name"=>"category"), $categoriesArray); ?></td>
    </tr>
</table>
<br>
<input type="submit" value="Move Product to Category" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>