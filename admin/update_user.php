<?php
include "../db_connect.php";

session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location:../Login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location:../home_user/home.php");
}

$id = $_GET["id"];
$sql = "SELECT * FROM users WHERE user_id = $id ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $picture = $_POST["picture"];
    $role = $_POST["role"];


    /* function clear($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["update"])) {
    $fname = clear($_POST["fname"]);
    $lname = clear($_POST["lname"]);
    $email = clear($_POST["email"]);
    $picture = $_POST["picture"];
 */
    $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`picture`='$picture',`role`='$role' WHERE user_id=$id ";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "success updating";
        header("refresh: 3; url = dashboard_users.php");
    } else {
        echo "error";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Update users </h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fname" class="form-label">First name</label>
                <input type="text" class="form-control" value="<?= $row["fname"] ?>" id="fname" aria-describedby="fname" name="fname">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name</label>
                <input type="text" class="form-control" value="<?= $row["lname"] ?>" id="lname" aria-describedby="lname" name="lname">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" value="<?= $row["email"] ?>" id="description" aria-describedby="email" name="email">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture link</label>
                <input type="text" class="form-control" value="<?= $row["picture"] ?>" id="picture" aria-describedby="picture" name="picture">
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Role</label>
                <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="role" class="form-control selectpicker">
                            <option value=" ">Please Choise The Role</option>
                            <option>blocked</option>
                            <option>user</option>
                        </select>
                    </div>
                </div>
            </div>


            <button name="update" type="submit" class="btn btn-primary mt-3">Update user</button>
            <a href="dashboard_users.php" class="btn btn-warning mt-3">Back to home page</a>
        </form>
    </div>

</body>

</html>