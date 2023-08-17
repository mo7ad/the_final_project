<?php
session_start();

require_once "../db_connect.php";

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
                    <a href='details.php?id=" . $row['recipes_id'] . "' class='btn btn-success btn-sm mr-2 mx-2' role='button'>More Info</a>
                    <a href='dateselect.php?id=" . $row['recipes_id'] . "&type=" . $row['type'] . "' class='btn btn-primary btn-sm' role='button'>Add to Plan</a>
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
        <h1 class="display-5 fw-bold mt-4">MealPlanner menu</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Choose your favourite dishes and organize your day!</p>
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



    <?php echo $cards ?>
    <div class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>
</body>

</html>