<?php

include "../db_connect.php";
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../home_user/home.php");
}

$id = $_GET["id"];
$sql = "SELECT * FROM `users` WHERE user_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$delete = "DELETE FROM `users` WHERE user_id = $id";
if (mysqli_query($connect, $delete)) {
    header("Location: dashboard_users.php");
} else {
}
