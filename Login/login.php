<?php
session_start();
include "../db_connect.php";
$error = false;
$email = $erroremail = $errorpassword = "";
function clear($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST["login"])) {
    $email = clear($_POST["email"]);
    $password = $_POST["pass"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $Emailerror = "error";
    }
    if (empty($password)) {
        $error = true;
        $passerror = "no";
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "SELECT * FROM `users` WHERE email ='$email' and pass='$password'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            if ($row["role"] == "user") {
                $_SESSION["user"] = $row["user_id"];
                header("Location: ../home_user/home.php");
            } elseif ($row["role"] == "admin") {
                $_SESSION["admin"] = $row["user_id"];
                header("Location: ../admin/dashboard_users.php");
            } elseif ($row["role"] == "blocked") {
                $_SESSION["blocked"] = $row["user_id"];
                header("Location:../home_user/blocked.php");
            }
        } else {
            echo "wrong";
        }
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../components/style.css">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        body {
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>


</head>




<body>

    <div class="login-box col-3" style="height: 500px; margin-top: 100px;">
        <form method="post">
            <div class="user-box">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                <label for="email" class="form-label ">Email address</label>
                <span class="text-danger"><?= $erroremail ?></span>
            </div>
            <div class="user-box">
                <input type="password" class="form-control " id="pass" name="pass">
                <label for="pass" class="form-label">Password</label>
            </div>
            <center>
                <a href="#">
                    <button name="login" type="submit" class="btn btn-link text-decoration-none text-light fs-4">Login</button><br>
                </a>
                <br>
                <span class="text_2">You don't have an account?</span><br>
                <a href="register.php" class="col-6">Sign up here</a>
            </center>
        </form>
    </div>

    <!--     <div class="container">
        <h1 class="text-center">Login page</h1>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                <span class="text-danger"><?= $erroremail ?></span>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
                <span class="text-danger"><?= $errorpassword ?></span>
            </div>
            <button name="login" type="submit" class="btn btn-primary">Login</button>

            <span>you don't have an account? <a href="register.php">sign up here</a></span>
        </form>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>