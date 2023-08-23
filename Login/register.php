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
    <link rel="stylesheet" href="../components/style.css">
    <style>
        body {
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 450px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;

        }

        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before,
        .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message,
        .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 15px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input+span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown+span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus+span,
        .form label .input:valid+span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid+span {
            color: green;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        .container {
            margin-top: 220px;
        }
    </style>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <form class="form" method="post">
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our webpage. </p>
            <div class="flex">
                <label for="fname" class="form-label">
                    <input placeholder="" type="text" class="form-control" id="fname" name="fname" value="<?= $fname ?>">
                    <span>Firstname</span>
                </label>

                <label for="lname" class="form-label">
                    <input placeholder="" type="text" class="form-control" id="lname" name="lname" value="<?= $lname ?>">
                    <span>Lastname</span>
                </label>
            </div>

            <label for="email" class="form-label">
                <input placeholder="" type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                <span>Email</span>
            </label>

            <label for="picture" class="form-label">
                <input placeholder="" type="text" class="form-control" id="picture" name="picture" placeholder="" value="<?= $picture ?>">
                <span>Picture url</span>
            </label>
            <label for="pass" class="form-label">
                <input placeholder="" type="password" class="form-control" id="pass" name="pass">
                <span>Password</span>
            </label>
            <button name="sign-up" class="submit">Submit</button>
            <p class="signin">Already have an acount ? <a href="login.php">Login</a> </p>
        </form>
    </div>










    <!-- <div class="container">
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
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>