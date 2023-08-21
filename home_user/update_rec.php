<?php
require_once "../db_connect.php";

$id = $_GET["id"];
$sql = "SELECT * FROM recipes WHERE recipes_id = $id ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $recipe_name = $_POST["recipe_name"];
    $prep_time = $_POST["prep_time"];
    $description = $_POST["description"];
    $calories = $_POST["calories"];
    $type = $_POST["type"];
    $url = $_POST["url"];
    $meal_type = $_POST["meal_type"];
    $ingredients = $_POST["ingredients"];

    $sql=" UPDATE `recipes` SET `recipe_name`='$recipe_name',`prep_time`='$prep_time',`description`='$description',`calories`='$calories',`type`='$type',`url`='$url',`meal_type`='$meal_type',`ingredients`='$ingredients' WHERE recipes_id=$id";

    if (mysqli_query($connect, $sql)) {
        echo "<span class='text_1'>Success</span>";
        header("refresh: 3; url = home.php");
    } else {
        echo "<span class='text_1'>Error</span>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Update</title>
    <link rel="stylesheet" href="../components/style.css">
    <style>
        .text_1 {
            color: yellow;
            font-size: 26px;
            font-weight: bold;
        }
    </style>


</head>

<body>
    <?php require_once '../components/navbar.php' ?>



    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Update your recipe</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="recipe_name" class="form-label">Recipe Name</label>
                        <input type="text" class="form-control" id="recipe_name" name="recipe_name" value="<?= $row["recipe_name"] ?>">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="prep_time" class="form-label">Preparation Time</label>
                            <input type="text" class="form-control" id="prep_time" name="prep_time" value="<?= $row["prep_time"] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="calories" class="form-label">Calories</label>
                        <input type="text" class="form-control" id="calories" name="calories" value="<?= $row["calories"] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="url" class="form-label">Picture URL</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?= $row["url"] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="meal_type" class="form-label">Meal time</label>
                        <select class="form-control" id="meal_type" name="meal_type" value="<?= $row["meal_type"] ?>">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Meal type</label>
                        <select class="form-control" id="type" name="type" value="<?= $row["type"] ?>">
                            <option value="vegan">Vegan</option>
                            <option value="vegeterian">Vegeterian</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <textarea class="form-control" id="ingredients" name="ingredients" rows="4" value="<?= $row["ingredients"] ?>"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Preparation description</label>
                        <textarea class="form-control" id="description" name="description" rows="6" value="<?= $row["description"] ?>"></textarea>
                    </div>


                    <button type="update" name="update" class="btn btn-success btn-lg">Update</button>
                    <a href='home.php' class='btn btn-primary btn-lg' style='width: auto;'>Home</a>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <?php require_once '../components/footer.php' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>