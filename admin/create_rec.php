<?php

session_start();
require_once "../db_connect.php";

$userID = $_SESSION["admin"];
$sqlUs = "SELECT * FROM users WHERE user_id = $userID";
$resultUs = mysqli_query($connect, $sqlUs);
$rowUs = mysqli_fetch_assoc($resultUs);


$recipe_name = $prep_time = $description = $calories = $type = $verified = $url = $meal_type = $ingredients = "";

if (isset($_POST["back"])) {
    header("Location: recipes.php");
}

if (isset($_POST["create"])) {


    $recipe_name = $_POST["recipe_name"];
    $prep_time = $_POST["prep_time"];
    $description = $_POST["description"];
    $calories = $_POST["calories"];
    $type = $_POST["type"];
    $url = $_POST["url"];
    $meal_type = $_POST["meal_type"];
    $ingredients = $_POST["ingredients"];


    $sql = "INSERT INTO recipes (recipe_name,description,prep_time,calories,type,url,meal_type,ingredients,fk_user_id) VALUES ('$recipe_name','$description','$prep_time','$calories','$type','$url','$meal_type','$ingredients',$userID)";

    if (mysqli_query($connect, $sql)) {

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
    <title< /title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="../home_user/create.css">
        <link rel="stylesheet" href="../components/style.css">
</head>
</head>

<body>

    <?php require_once '../components/admin_navbar.php' ?>

    <div class="formContainer">


        <div class="form-box col-6">
            <form class="form" method="post">
                <span class="title">Create recipe!</span>
                <span class="subtitle">Share with us your favourite recepies</span>
                <div class="form-container">
                    <input name="recipe_name" type="text" class="input bg-white text-black fs-6" placeholder="Recipe name">
                    <input name="prep_time" type="text" class="input bg-white text-black fs-6" placeholder="Preparation time ex. xxx/minutes">
                    <input name="calories" type="text" class="input bg-white text-black fs-6" placeholder="Number of calories">
                    <textarea class="form-control" class="input" name="url" placeholder="Picture link"></textarea>
                    <textarea class="form-control" class="input" name="description" placeholder="Cooking Description"></textarea>
                    <textarea class="form-control" class="input" name="ingredients" placeholder="Ingredients"></textarea>
                    <select name="meal_type" class="form-control selectpicker">
                        <option value="Please select your meal time">Please select your meal type</option>
                        <option>Breakfast</option>
                        <option>Lunch</option>
                        <option>Dinner</option>
                    </select>
                    <select name="type" class="form-control selectpicker" placeholder="Select your diet">
                        <option value=" ">Please select your meal diet</option>
                        <option>Vegeterian</option>
                        <option>Vegan</option>
                        <option>Normal</option>
                    </select>
                </div>
                <button name="create">Create</button>
            </form>

        </div>
    </div>

    <div class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>