<?php
require_once "../db_connect.php";


session_start();
if (isset($_SESSION["user"])) {
    header("location: ../home_user/home.php");
    exit();
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("location: ../Login/login.php");
    exit();
}

$sqlPersons = "SELECT * FROM `users`";
$resultPersons = mysqli_query($connect, $sqlPersons);
$rowPersons = mysqli_fetch_assoc($resultPersons);

$layout = "";

if (mysqli_num_rows($resultPersons) > 0) {
    while ($userPerson = mysqli_fetch_assoc($resultPersons)) {
        $layout .= "<div>
            <div class='card mb-5 card_users' style='width: 18rem;'>
                <img src='{$userPerson["picture"]}' class='card-img-top' alt='...' style='height: 300px; object-fit: cover;'>
                <div class='card-body'>
                    <h5 class='card-title'>User: {$userPerson["fname"]} {$userPerson["lname"]}</h5>
                    <p class='card-text fs-5'>Email: {$userPerson["email"]}</p>
                    <a href='update_user.php?id={$userPerson["user_id"]}' class='btn btn-warning'>Update</a>
                    <a href='delete_user.php?id={$userPerson["user_id"]}' class='btn btn-danger'>Delete</a>
                </div>
            </div>
        </div>";
    }
} else {
    $layout .= "No results found!";
}




mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/bootstrap.php' ?>
    <link rel="stylesheet" href="../components/style.css">
    <title>Welcome <?= $rowPersons["fname"] ?></title>
</head>

<body class="background_user">
    <?php require_once '../components/admin_navbar.php' ?>


    <h1 class="text_1 text-center my-4">Welcome <?= $rowPersons["fname"] . " " . $rowPersons["lname"] ?></h1>




    <div class="container">
        <p class="text-white fs-4">Click down to create a new user:</p>
        <form class="my-4">
            <a href='create_user.php' class='btn btn-warning '>Create</a>
        </form>
        <div class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-1 row-cols-xs-1">
            <?= $layout ?>
        </div>
    </div>




    <div class="footer">
        <?php require_once '../components/footer.php' ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>