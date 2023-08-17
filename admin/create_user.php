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
