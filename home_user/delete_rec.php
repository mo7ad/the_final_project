<?php
     require_once "../db_connect.php";

     $id = $_GET["id"];
     $sql = "DELETE FROM `recipes` WHERE recipes_id = $id";
     if(mysqli_query($connect, $sql)){
        header("location: home.php");
     }else{
        echo "Error";
     }

?>