

<br>
<?php
htmlRender::generateAntiForgeryToken();
htmlRender::beginForm(array("action"=>"authentication/login", "method"=>"POST"));
?>
    <table>
        <h3>Login Form</h3>
        <tr>
            <td>Username:</td><td><?php htmlRender::textField(array("name" => "username")) ?></td>
        </tr>
        <tr>
            <td>Password:</td><td><?php htmlRender::passwordField(array("name" => "password")) ?></td>
        </tr>
    </table>
    <input type="submit" value="Login">
<?php htmlRender::endForm(); ?>

<br>
<br>
<br>

<?php htmlRender::beginForm(array("action"=>"authentication/register", "method"=>"POST")); ?>
    <table>
        <h3>Register Form</h3>
        <tr>
            <td>Username:</td><td><?php htmlRender::textField(array("name" => "username")) ?></td>
        </tr>
        <tr>
            <td>Password:</td><td><?php htmlRender::passwordField(array("name" => "password")) ?></td>
        </tr>
        <tr>
            <td>Confirm Password:</td><td><?php htmlRender::passwordField(array("name" => "confirmPassword")) ?></td>
        </tr>
        <tr>
            <td>Admin Password:</td><td><?php htmlRender::passwordField(array("name" => "adminPassword")) ?>&nbsp;<label>Leave empty if not known</label></td>
        </tr>
        <tr>
            <td>First Name:</td><td><?php htmlRender::textField(array("name" => "firstName")) ?></td>
        </tr>
        <tr>
            <td>Last Name:</td><td><?php htmlRender::textField(array("name" => "lastName")) ?></td>
        </tr>
    </table>
    <input type="submit" value="Register">
<?php htmlRender::endForm(); ?>