
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php

$categoriesArray = array();
foreach($model as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"addProduct", "method"=>"POST"));
?>

<table class="table">
    <tr>
        <td>Name</td>
        <td><?php htmlRender::textField(array("name" => "name")) ?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><?php htmlRender::textField(array("name" => "price")) ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php htmlRender::DropDown(array("name"=>"category"), $categoriesArray); ?></td>
    </tr>
</table>
<br>
<input type="submit" value="Add New Product" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>