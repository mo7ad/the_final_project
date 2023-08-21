<?php
     require_once "../db_connect.php";

     $id = $_GET["id"];
     $sql = "DELETE FROM `recipes` WHERE recipes_id = $id";
     if(mysqli_query($connect, $sql)){
        header("location: my_recipes.php");
     }else{
        echo "Error";
     }

?>