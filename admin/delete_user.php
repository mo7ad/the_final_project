<?php
include "../db_connect.php";
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])){ 
    header("Location: ../login/login.php"); 
}

if(isset($_SESSION["user"])){ 
    header("Location: ../home_user/home.php"); 
}


$sql="SELECT * FROM `users`";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($result);
$delete="DELETE FROM `users`";
if(mysqli_query($connect,$delete)){
header("Location: ../dashboard.php");
}else{

}
?> 