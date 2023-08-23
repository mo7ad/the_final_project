<?php
include "../db_connect.php";

session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location:../Login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location:../home_user/home.php");
}

if (isset($_POST["back"])) {
    header("Location:../admin/dashboard_users.php");
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

        header("refresh: 3; url = dashboard_users.php");
    } else {
        echo "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title< /title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="../home_user/create.css">
        <link rel="stylesheet" href="../components/style.css">
</head>
</head>

<body>

    <?php require_once '../components/admin_navbar.php' ?>


    <div class="formContainer">


        <div class="form-box">
            <form class="form" method="post">
                <span class="title">Update User</span>

                <div class="form-container">
                    <input name="fname" type="text" class="input" placeholder="Recipe name" value="<?= $row["fname"] ?>">
                    <input name="lname" type="text" class="input" placeholder="Preparation time ex. xxx/minutes" value="<?= $row["lname"] ?>">
                    <input name="email" type="text" class="input" placeholder="Email Address" value="<?= $row["email"] ?>">
                    <input name="picture" type="text" class="input" placeholder="Picture Link" value="<?= $row["picture"] ?>">
                    <!-- <input name="role" type="text" class="input" placeholder="Users Role" value="<?= $row["role"] ?>"> -->
                    <select name="role" type="text" class="input" placeholder="Select role" value="<?= $row["role"] ?>">
                        <option value=" ">Select role</option>
                        <option>user</option>
                        <option>admin</option>
                        <option>blocked</option>
                    </select>

                </div>
                <button name="update">Update</button>
                <button name="back">Back to home page</button>
            </form>

        </div>
    </div>

    <div class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>