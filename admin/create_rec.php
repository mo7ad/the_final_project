<?php

session_start();
require_once "../db_connect.php";

$userID = $_SESSION["admin"];
$sqlUs = "SELECT * FROM users WHERE user_id = $userID";
$resultUs = mysqli_query($connect, $sqlUs);
$rowUs = mysqli_fetch_assoc($resultUs);


$recipe_name = $prep_time = $description = $calories = $type = $verified = $url = $meal_type = $ingredients = "";

if (isset($_POST["create"])) {


    $recipe_name = $_POST["recipe_name"];
    $prep_time = $_POST["prep_time"];
    $description = $_POST["description"];
    $calories = $_POST["calories"];
    $type = $_POST["type"];
    $verified = $_POST["verified"];
    $url = $_POST["url"];
    $meal_type = $_POST["meal_type"];
    $ingredients = $_POST["ingredients"];


    $sql = "INSERT INTO recipes (recipe_name,description,prep_time,calories,type,url,verified,meal_type,ingredients,fk_user_id) VALUES ('$recipe_name','$description','$prep_time','$calories','$type','$url','$verified', '$meal_type','$ingredients',$userID)";

    if (mysqli_query($connect, $sql)) {
        echo "success";
        header("refresh: 3; url = recipes.php");
    } else {
        echo "failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../components/style.css">
    <style>
        body {
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-repeat: no-repeat;
        }

        /*         .container_center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 600px;
        } */
    </style>
</head>


<body>
    <div class="container col-4 bg-light rounded" style="min-height: 100vh;">

        <form method="post">
            <div class="user-box">
                <label for="recipe_name" class="form-label">Recipe</label>
                <input type="text" class="form-control" id="recipe_name" name="recipe_name" placeholder="" value="<?= $recipe_name ?>">
            </div>

            <div class="user-box">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="" value="<?= $description ?>"></textarea>
            </div>

            <div class="user-box">
                <label for="prep_time" class="form-label">Preperation Time</label>
                <input type="text" class="form-control" id="prep_time" name="prep_time" placeholder="" value="<?= $prep_time ?>">

            </div>

            <div class="user-box">
                <label for="calories" class="form-label">Calories</label>
                <input type="calories" class="form-control" id="calories" name="calories" placeholder="" value="<?= $calories ?>">

            </div>

            <div class="user-box">
                <label for="url" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="" value="<?= $url ?>">
            </div>

            <div class="user-box">
                <label for="verified" class="form-label">Verified</label>
                <select type="text" name="verified" id="verified" class="form-control selectpicker">
                    <option value=" ">Please verify the recipe</option>
                    <option>unverified</option>
                    <option>verified</option>
                </select>
            </div>

            <div class="user-box">
                <label for="meal_type" class="form-label">Meal Time</label>
                <select type="text" name="meal_type" id="meal_type" class="form-control selectpicker">
                    <option value=" ">Choose:</option>
                    <option>Breakfest</option>
                    <option>Lunch</option>
                    <option>Dinner</option>
                </select>
            </div>

            <div class="user-box">
                <label for="type" class="form-label">Meal Type</label>
                <select type="text" name="type" id="type" class="form-control selectpicker">
                    <option value=" ">Please select your food type</option>
                    <option>Vegan</option>
                    <option>Vegeterian</option>
                    <option>Normal</option>
                </select>
            </div>

            <div class="user-box">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" placeholder="" value="<?= $ingredients ?>"></textarea>
            </div>

            <div class="my-4">
                <button type="submit" class="btn btn-warning" name="create">Send <span class="glyphicon glyphicon-send"></span></button>
            </div>

        </form>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>