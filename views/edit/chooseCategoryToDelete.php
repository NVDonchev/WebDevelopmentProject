
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php

$categoriesArray = array();
foreach($model as $category) {
    array_push($categoriesArray, array("value"=>$category, "content"=>ucfirst($category)));
}

htmlRender::beginForm(array("action"=>"deleteCategory", "method"=>"POST"));
?>

<table class="table">
    <tr>
        <td>Category</td>
        <td><?php htmlRender::DropDown(array("name"=>"category"), $categoriesArray); ?></td>
    </tr>
</table>
<br>
<input type="submit" value="Delete Category" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>