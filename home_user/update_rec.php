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

    $sql = " UPDATE `recipes` SET `recipe_name`='$recipe_name',`prep_time`='$prep_time',`description`='$description',`calories`='$calories',`type`='$type',`url`='$url',`meal_type`='$meal_type',`ingredients`='$ingredients' WHERE recipes_id=$id";

    if (mysqli_query($connect, $sql)) {

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
    <title< /title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="create.css">
</head>
</head>

<body>
    <?php require_once '../components/navbar.php' ?>


    <div class="formContainer">


        <div class="form-box">
            <form class="form" method="post">
                <span class="title">Update your recipe!</span>
                <span class="subtitle">Update your existing recipes</span>
                <div class="form-container">
                    <input name="recipe_name" type="text" class="input bg-white text-black fs-6" placeholder="Recipe name" value="<?= $row["recipe_name"] ?>">
                    <input name="prep_time" type="text" class="input bg-white text-black fs-6" placeholder="Preparation time ex. xxx/minutes" value="<?= $row["prep_time"] ?>">
                    <input name="calories" type="text" class="input bg-white text-black fs-6" placeholder="Number of calories" value="<?= $row["calories"] ?>">
                    <textarea class="form-control" class="input" name="url" placeholder="Picture link" value="<?= $row["url"] ?>"><?= $row["url"] ?></textarea>
                    <textarea class="form-control" class="input" name="description" placeholder="Cooking Description" value="<?= $row["description"] ?>"><?= $row["description"] ?></textarea>
                    <textarea class="form-control" class="input" name="ingredients" placeholder="Ingredients" value="<?= $row["ingredients"] ?>"><?= $row["ingredients"] ?></textarea>
                    <select name="meal_type" class="form-control selectpicker" value="<?= $row["meal_type"] ?>">
                        <option><?= $row["meal_type"] ?></option>
                        <option>Breakfast</option>
                        <option>Lunch</option>
                        <option>Dinner</option>
                    </select>
                    <select name="type" class="form-control selectpicker" placeholder="Select your diet" value="<?= $row["type"] ?>">
                        <option value=" "><?= $row["type"] ?></option>
                        <option>Vegeterian</option>
                        <option>Vegan</option>
                        <option>Normal</option>
                    </select>
                </div>
                <button name="update">Update</button>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>