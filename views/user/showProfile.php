
<?php include PATH_TO_APP . "views/_header.php"; ?>

<table class="table">
    <tr>
        <td>First Name:</td>
        <td><?php echo $this->model->firstName ?></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><?php echo $this->model->lastName ?></td>
    </tr>
    <tr>
        <td>Cash:</td>
        <td><?php echo $this->model->cash ?></td>
    </tr>
    <tr>
        <td>Role:</td>
        <td><?php echo $this->model->role ?></td>
    </tr>
</table>

<a href="../home" class="btn btn-info">Go Home</a>

<?php include PATH_TO_APP . "views/_footer.php"; ?>