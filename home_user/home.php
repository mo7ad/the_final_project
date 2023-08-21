<?php
session_start();

require_once "../db_connect.php";

if (isset($_SESSION['admin'])) {
    header("Location: ../admin/dashboard_users.php");
    exit;
}

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}


$user_id = $_SESSION["user"];

$sqlPersons = "SELECT * FROM `users` WHERE user_id = $user_id";
$resultPersons = mysqli_query($connect, $sqlPersons);
$rowPersons = mysqli_fetch_assoc($resultPersons);


$sql = "SELECT * FROM `recipes`";
$result = mysqli_query($connect, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $cards .= "<div class='col-md-4 mb-4'>
        <div class='card h-100 shadow'>
            <img src='" . $row['url'] . "' class='card-img-top' style='object-fit: cover; height: 200px;' alt='" . $row['recipe_name'] . "'>
            <div class='card-body'>
                <h4 class='card-title text-center'><i>" . $row['recipe_name'] . "</i></h4>
                <ul class='list-unstyled mb-3'>
                    <li><strong>Type:</strong> " . $row['type'] . "</li>
                    <li><strong>Preparation time:</strong> " . $row['prep_time'] . "</li>
                    <li><strong>Calories:</strong> " . $row['calories'] . "</li>
                    <li><strong>Diet:</strong> " . $row['meal_type'] . "</li>
                </ul>
                <div class='d-flex justify-content-center'>
                    <a href='details.php?id=" . $row['recipes_id'] . "' class='btn btn-outline-success btn-sm mr-2 mx-2' role='button'>More Info</a>
                    <a href='select_date.php?id=" . $row['recipes_id'] ."' class='btn btn-outline-primary btn-sm' role='button'>Add to Plan</a>
                </div>
            </div>
        </div>
    </div>";
    }
} else {
    $cards = "<p>No results found!</p>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/style.css">
    <title>Welcome <?php echo $rowPersons["fname"]; ?></title>

    <?php require_once '../components/bootstrap.php' ?>

</head>

<body>
    <?php require_once '../components/navbar.php' ?>

    <div class="px-4 py-5 mb-5 text-center bordered shadow" style="background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;">
       <div class="transparent-bg"  style="background-color: rgba(255, 255, 255, 0.1);padding: 10px; display: inline-block; border-radius: 100px; ">
         <h1 style="padding-top: 40px;" class="display-5 fw-bold mt-4 ">MealPlanner menu</h1>
         <div class="col-lg-6 mx-auto">
             </div>     <p class="lead mb-4">Choose your favourite dishes and organize your day!</p>
            <div class="d-grid gap-2 d-flex justify-content-center">
                <form method="POST" action="filter.php">
                    <select name="category" class="ps-4 pe-4 p-3 rounded shadow" style="background-color: #E6E7EB">
                        <option value="#">Your personal filter: </option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="high-protein">vegan</option>
                        <option value="regular">Normal</option>
                        <option value="vegetarian">Vegetarian</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-md mt-2" name="filter">Look for it!</button>
                </form>
            </div>
        </div>
    </div>


    <!-- arro====== -->
    <div class="arrow">
        <a href="#cards"><svg id="arrow" xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg></a>
    </div>
    <!-- arro====== -->


    <div class="container">
        <div id="cards" class="row row-cols-lg-3 ">
            <?php echo $cards; ?>
        </div>
    </div>
    <div class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>
</body>

</html>