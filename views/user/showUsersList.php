
<?php include PATH_TO_APP . "views/_header.php"; ?>

<?php htmlRender::beginForm(array("action"=>"changeUserRole", "method"=>"POST")); ?>
<table class="table">
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Change Role</th>
    </tr>
    <?php foreach( $model as $user ) :?>
        <tr>
            <td><?php echo $this->htmlSpecialCharsConditional($user->username, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($user->firstName, false); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($user->lastName); ?></td>
            <td><?php echo $this->htmlSpecialCharsConditional($user->role); ?></td>
            <td><?php htmlRender::radioButton(array("name" => "username", "value" => $user->username))?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<input type="submit" value="Change role" class="btn btn-success"><br>
<?php htmlRender::endForm(); ?>
<br>

<a href="../home" class="btn btn-info">Go Home</a>

<?php include PATH_TO_APP . "views/_footer.php"; ?>