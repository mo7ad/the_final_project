<?php
session_start();
include "../db_connect.php";
$error=false;
$email=$erroremail=$errorpassword="";
function clear($input){
    $data=trim($input);
    $data=strip_tags($data);
    $data=htmlspecialchars($data);
    return $data;
    }
    if(isset($_POST["login"])){
        $email=clear($_POST["email"]);
        $password=$_POST["pass"];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error=true;
            $Emailerror="error";
            
            
            
            }if(empty($password)){
                $error=true;
                $passerror="no";
                }
                if(!$error){
                    $password=hash("sha256",$password);
                    $sql="SELECT * FROM `users` WHERE email ='$email' and pass='$password'";
                    $result=mysqli_query($connect,$sql);
                    $row=mysqli_fetch_assoc($result);
                    if(mysqli_num_rows($result)==1){
                    if($row["role"]=="user"){
                    $_SESSION["user"]=$row["user_id"];
                    header("Location: homepage.php");
                    }else{
                        $_SESSION["adm"]=$row["user_id"];
                        header("Location: dashboard.php");
                    }

                    }else {
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
        <title>Login page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Login page</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                    <span class="text-danger"><?= $erroremail ?></span>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="pass" class="form-control" id="pass" name="pass">
                    <span class="text-danger"><?= $errorpassword ?></span>
                </div>
                <button name="login" type="submit" class="btn btn-primary">Login</button>
                
                <span>you don't have an account? <a href="register.php">sign up here</a></span>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>