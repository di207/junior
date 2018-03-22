<?php
// set page headers
$title = "Create User";
require_once("../header.php");
require_once('db.php');
require_once('user.php');

$database = new DBConnection();
$db = $database->getConnection();


if($_POST) {
    $user = new User($db);

    switch ($_POST['action']) {
        case "create":
            // set user property values
            $email = $_POST['email'];
            $status = $_POST['status'];
            // create user
            if($user->create($email, $status)){
                echo "<div class='alert alert-success'>User created.</div>";
            } else {
                echo "<div class='alert alert-danger'>Unable to create user.</div>";
            }
            break;
        case "find":
            $emailOrId = $_POST['emailOrId'];
            // create user
            $result = $user->getUserFromIdOrEmail($emailOrId);

            if(count($result) > 0) {
                echo "<div class='alert alert-success'>User finded.</div>";
                print_r($result);
            } else {
                echo "<div class='alert alert-danger'>Unable to fined user.</div>";
            }
            break;
        case "update":
            // set user property values
            $userid = $_POST['userid'];
            $status = $_POST['status'];
            // create user
            if($user->update($userid, $status)){
                echo "<div class='alert alert-success'>User updated.</div>";
            } else {
                echo "<div class='alert alert-danger'>Unable to update user.</div>";
            }
            break;
    }
}

?>

<form action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control'/>
                <input type="hidden" name="action" value="create"/></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type='text' name='status' class='form-control'/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
    </table>
</form>

<form action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Email or id</td>
            <td><input type='text' name='emailOrId' class='form-control'/>
                <input type="hidden" name="action" value="find"/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Find</button>
            </td>
        </tr>
    </table>
</form>

<form action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>User id</td>
            <td><input type='text' name='userid' class='form-control'/>
                <input type="hidden" name="action" value="update"/></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type='text' name='status' class='form-control'/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
    </table>
</form>

