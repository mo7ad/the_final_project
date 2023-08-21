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

$sql = "SELECT * FROM `recipes`";
$result = mysqli_query($connect, $sql);

$layout = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout .=
            "<div class='col-md-4 mb-4'>
                <div class='card h-100 shadow'>
                    <img src='{$row["url"]}' class='card-img-top' style='object-fit: cover; height: 320px; width:100%;' alt=''>
                    <div class='card-body'>
                    <h4 class='card-title text-center'><i>{$row["recipe_name"]}</i></h4>
                    <ul class='list-unstyled mb-3'>
                        <li class='text-center'><strong>Preperation Time: </strong>{$row["prep_time"]}</li>
                        <li class='text-center'><strong>Type: </strong>{$row["type"]}</li>
                        <li class='text-center'><strong>Meal Type: </strong>{$row["meal_type"]}</li>
                    </ul>
                    
                <div class='d-flex justify-content-center'>
                <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#exampleModal{$row['recipes_id']}'>Delete
                </button>
                <a href='update_rec.php?id={$row["recipes_id"]}' class='btn btn-outline-warning mx-3'>Update</a>
                <a href='../home_user/details.php?id={$row["recipes_id"]}' class='btn btn-outline-secondary'>Details</a> </div>
                
            </div>
            </div>

        <div class='modal fade' id='exampleModal{$row['recipes_id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    Are you sure you want to delete the record?
                </div>

                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>NO</button>
                    <a href='delete_rec.php?id={$row['recipes_id']}' class='btn btn-danger'>YES</a>
                </div>
            </div>
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

</head>

<body>
    <?php require_once '../components/admin_navbar.php' ?>


    <div class="px-4 py-5 mb-5 text-center bordered shadow" style="height:500px; background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;">
        <div class="transparent-bg" style="background-color: rgba(255, 255, 255, 0.1);padding: 10px; display: inline-block; border-radius: 100px; ">
            <h2 class="text-center text_1 my-3">Welcome <?= $rowPersons["fname"] . " " . $rowPersons["lname"] ?></h2>
            <h1 style="padding-top: 10px; text-shadow: 2px 2px 2px orange; font-size:60px;" class="display-5 fw-bold mt-3">MealPlanner menu</h1>
            <div class="col-lg-6 mx-auto">
            </div>
            <p class="lead mb-4 fs-3 text-warning" style="text-shadow: 2px 2px 2px black;"><strong>Choose your favourite <br>dishes and organize your day!</strong></p>
            <form class="my-4">
                <a href='create_rec.php' class='btn btn-outline-warning col-6 fs-3' style='box-shadow: 2px 2px 2px black;'>Create recipe</a>
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