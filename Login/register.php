<?php
include "../db_connect.php";
$error = false;
$fname = $lname = $email = $password = $role = $picture = "";
$errorfname = $errorlname = $erroremail = $errorpassword = $errorpicture = "";
function clear($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST["sign-up"])) {
    $fname = clear($_POST["fname"]);
    $lname = clear($_POST["lname"]);
    $email = clear($_POST["email"]);
    $password = $_POST["pass"];
    $picture = $_POST["picture"];

    if (empty($fname)) {
        $error = true;
        $errorfname = "please write your first name";
    } elseif (strlen($fname < 2)) {
        $error = true;
        $errorfname = "no";
    }
    if (empty($lname)) {
        $error = true;
        $errorlname = "please write your last name";
    } elseif (strlen($lname) < 2) {
        $error = true;
        $errorlname = "no";
    }
    if (empty($picture)) {
        $error = true;
        $errorpicture = "please write the image link";
    } elseif (strlen($picture) < 2) {
        $error = true;
        $errorpicture = "no";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $erroremail = "no";
    }
    if (empty($password)) {
        $error = true;
        $errorpassword = "no";
    } else {
        $sql = "SELECT * FROM `users` WHERE email= '$email'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $errorpassword = "no";
        }
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "INSERT INTO `users`( `fname`, `lname`, `email`, `pass`,  `picture`) VALUES ('$fname','$lname','$email','$password','$picture')";
        $result = mysqli_query($connect, $sql);
        header("Location: login.php");
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Sign up page</h1>
        <form method="post">
            <div class="mb-3">
                <label for="fname" class="form-label">First name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="<?= $fname ?>">
                <span class="text-danger"><?= $errorfname ?></span>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="<?= $lname ?>">
                    <span class="text-danger"><?= $errorlname ?></span>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?= $email ?>">
                        <span class="text-danger"><?= $erroremail ?></span>
                    </div>
                    <label for="picture" class="form-label">Image link</label>
                    <input type="text" class="form-control" id="picture" name="picture" placeholder="" value="<?= $picture ?>">
                    <span class="text-danger"><?= $errorpicture ?></span>
                    <div class="mb-3">


                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                            <span class="text-danger"><?= $errorpassword ?></span>
                        </div>
                        <button name="sign-up" type="submit" class="btn btn-primary">join</button>

                        <span>you have an account? <a href="login.php">login here</a></span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>