
<?php include PATH_TO_APP . "views/_header.php"; ?>


<?php htmlRender::beginForm(array("action"=>"quantityChanged", "method"=>"POST")); ?>

<input type=hidden name="productId" value="<?php echo  $model->id ?>">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>New Quantity</th>
    </tr>
        <tr>
            <td><?php echo $this->htmlSpecialCharsConditional($model->name, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($model->price, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($model->category); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($model->quantity); ?></td>
            <td><?php htmlRender::textField(array("name" => "quantity"))?></td>
        </tr>
</table>
<br>
<input type="submit" value="Delete Product" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<?php include PATH_TO_APP . "views/_footer.php"; ?>