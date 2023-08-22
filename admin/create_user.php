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
        $errorfname = "Please write your first name";
    } elseif (strlen($fname) < 2) {
        $error = true;
        $errorfname = "First name must be at least 2 characters long";
    }

    if (empty($lname)) {
        $error = true;
        $errorlname = "Please write your last name";
    } elseif (strlen($lname) < 2) {
        $error = true;
        $errorlname = "Last name must be at least 2 characters long";
    }

    if (empty($picture)) {
        $error = true;
        $errorpicture = "Please write the image link";
    } elseif (strlen($picture) < 2) {
        $error = true;
        $errorpicture = "Image link must be at least 2 characters long";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $erroremail = "Invalid email format";
    }

    if (empty($password)) {
        $error = true;
        $errorpassword = "Please provide a password";
    } else {
        $sql = "SELECT * FROM `users` WHERE email= '$email'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $errorpassword = "Email already in use";
        }
    }

    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "INSERT INTO `users`( `fname`, `lname`, `email`, `pass`,  `picture`) VALUES ('$fname','$lname','$email','$password','$picture')";
        $result = mysqli_query($connect, $sql);
        header("Location: /Login/login.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../components/style.css">
    <style>
        body {
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="container col-4 bg-light rounded" style="margin-top: 200px;">
        <h1 class="text-center text_1 pt-3">Create a New User</h1>
        <form method="post">
            <div class="user-box">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="<?= $fname ?>">
                <span class="text-danger"><?= $errorfname ?></span>
            </div>

            <div class="user-box">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="<?= $lname ?>">
                <span class="text-danger"><?= $errorlname ?></span>
            </div>

            <div class="user-box">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?= $email ?>">
                <span class="text-danger"><?= $erroremail ?></span>
            </div>

            <div class="user-box">
                <label for="picture" class="form-label">Image Link</label>
                <input type="text" class="form-control" id="picture" name="picture" placeholder="" value="<?= $picture ?>">
                <span class="text-danger"><?= $errorpicture ?></span>
            </div>

            <div class="user-box">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
                <span class="text-danger"><?= $errorpassword ?></span>
            </div>

            <button name="sign-up" type="submit" class="btn btn-outline-success my-3">Create</button>
            <span style="padding-left: 25px; font-size: 18px;">Already have an account? <a href="/Login/login.php" class="mx-3">Login here</a></span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>