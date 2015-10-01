
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php

htmlRender::beginForm(array("action"=>"addCategory", "method"=>"POST"));
?>

<table class="table">
    <tr>
        <td>Name</td>
        <td><?php htmlRender::textField(array("name" => "name")) ?></td>
    </tr>
</table>
<br>
<input type="submit" value="Add New Category" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>