<?php
include "../db_connect.php";
$error = false;
$fname = $lname = $email = $password = $role = $picture = "";
$errorfname = $errorlname = $erroremail = $errorpassword = $errorpicture = "";

if (isset($_POST["back"])) {
    header("Location: recipes.php");
}


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
        header("Location: dashboard_users.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../home_user/create.css">
  <link rel="stylesheet" href="../components/style.css">
  </head>
</head>
<body>

<?php require_once '../components/admin_navbar.php' ?>

<div class="formContainer">


<div class="form-box">
<form class="form" method="post">
    <span class="title">Create user!</span>
    
    <div class="form-container">
        <input name="fname" type="text" class="input"  placeholder="First Name">
	    <input name="lname" type="text" class="input" placeholder="Last Name">
		<input name="email" type="text" class="input" placeholder="Email">
        <input name="pass" type="password" class="input" placeholder="Password">
        <input name="picture" type="text" class="input" placeholder="Picture url">
        
    </div>
    <button name="sign-up">Create</button>
    <button name="back">Go Back</button>
    
</form>

</div>
</div>

<div class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>