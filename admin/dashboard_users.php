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
        $layout .=
            "<div class='col-md-4 mb-4'>
        <div class='card h-100'>
            <img src='{$userPerson["picture"]}' class='card-img-top' style='object-fit: cover; height: 100%; width:100%;' alt=''>
            <div class='card-body'>
                <h4 class='card-title text-center'><i>User: {$userPerson["fname"]} {$userPerson["lname"]}</i></h4>
                <ul class='list-unstyled mb-3'>
                    <li class='text-center'><strong>Email: </strong>{$userPerson["email"]}</li>
                    <li class='text-center'><strong>Role: </strong>{$userPerson["role"]}</li>
                </ul>
                <div class='d-flex justify-content-center'>
                <a href='update_user.php?id={$userPerson["user_id"]}' class='btn btn-outline-success mx-3'>Update</a>
                <a href='delete_user.php?id={$userPerson["user_id"]}' class='btn btn-outline-danger'>Delete</a> </div>
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
    <link rel="stylesheet" href="../components/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&display=swap" rel="stylesheet">
    <title>Welcome <?php echo $rowPersons["fname"]; ?></title>

    <?php require_once '../components/bootstrap.php' ?>

    <style>
        /* Add the sliding text animation styles here */
        .sliding-text-container {
            position: relative;
            width: 100%;
            height: 130px;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0);
        }

        .sliding-text {
            position: absolute;
            top: 10%;
            left: 0;
            transform: translateY(-50%);
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 2em;
            animation: slide-up 8s linear infinite;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }


        /* Style for the card when not hovered */
        .card {
            transition: transform 0.2s, filter 0.2s;
            filter: brightness(1);
            /* Reset brightness */
            transition: border-color 0.3s ease;
            border: 0;
        }

        /* Style for the card when hovered */
        .card:hover {
            transform: translateY(-5px);
            /* Lift the card slightly */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow */
            filter: brightness(1.2);
        }

        /* Style for other cards when a card is hovered */
        .card:hover~.card {
            filter: blur(2px);
            /* Apply blur to other cards */
        }
    </style>

</head>

<body>
    <?php require_once '../components/admin_navbar.php' ?>

    <div class="px-4 py-5 mb-5 text-center bordered shadow" style="height:500px; background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;">
        <div class="transparent-bg" style="background-color: rgba(255, 255, 255, 0.1);padding: 10px; display: inline-block; border-radius: 100px; ">
            <h1 style="text-shadow: 2px 2px 2px white; letter-spacing: 4px; font-size: 55px;" class="display-5 fw-bold mt-4">MealPlanner menu</h1>
            <div class="col-lg-6 mx-auto">
            </div>
            <div class="sliding-text-container">
                <div class="sliding-text">
                    <p style="text-shadow: 2px 2px 2px black;"><strong>Choose your favorite<br>dishes and organize your day!</strong></p>
                </div>
            </div>
            <form class="my-4">
                <a href='create_user.php' class='btn btn-outline-light col-5 fs-2 shake' style='box-shadow: 2px 2px 2px black;'>Create user</a>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-lg-3 ">
            <?php echo $layout; ?>
        </div>
    </div>

    <div class="footer">
        <?php require_once '../components/footer.php' ?>
    </div>

</body>

</html>