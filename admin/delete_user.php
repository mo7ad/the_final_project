<?php
include "../db_connect.php";
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ 
    header("Location: login/login.php"); 
}

if(isset($_SESSION["user"])){ 
    header("Location: homepage.php"); 
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