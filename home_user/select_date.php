<?php
session_start();

require_once "../components/db_connect.php";

$error = false;
$mealError = '';
$id = $_GET['id'];

// var_dump($id);
// exit();

// if ($_GET) {
//     // $date = $_GET['date'];


//     if (isset($_SESSION['admin'])) {
//         $val = $_SESSION['admin'];
//     }
//     if (isset($_SESSION['user'])) {
//         $val = $_SESSION['user'];
//     }
// }

$query = "SELECT * FROM `recipes` WHERE fk_user_id= $_SESSION[user]";

$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
// $count = mysqli_num_rows($result);

// if ($count != 0) {
//     $error = true;

//     if ($type == "breakfast") {
//         $class = "danger";
//         $mealError = "Breakfast has already been chosen for this date. Select a different meal type.";
//     }
//     if ($type == "lunch") {
//         $class = "danger";
//         $mealError = "Lunch has already been chosen for this date. Select a different meal type.";
//     }
//     if ($type == "dinner") {
//         $class = "danger";
//         $mealError = "Dinner has already been chosen for this date. Select a different meal type.";
//     } else {
//         $class = "danger";
//         $mealError = "You have already planned your menu for this date.";
//     }
// }

if (isset($_POST["submit"])) {
    $date = $_POST["date"];


    if (!$error) {
        $sql = "INSERT INTO meal_planner (planner_id, date, fk_user_id, fk_recipes_id)
            VALUES (NULL, '$date', $_SESSION[user], $id)";

        if (mysqli_query($connect, $sql)) {
            $class = "success";
            $message = "Meal successfully added to your meal planner!";
            echo "<h1 class='text-white'>success</h1> success";
            header("refresh:2; url=meal_planner.php");
        } else {
            echo "error";
            $class = "danger";
            $message = "Error while creating record. Please try again: <br>";
            // . $connect->error;
        }
    }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../components/bootstrap.php' ?>
    <style>
        body {
            text-align: center;
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
        }

        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
            opacity: 0.9;
            background-color: white;
        }

        .btn {
            width: 12vw;
        }

        body {
            background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btn {
            width: 10vw;
        }
    </style>
</head>

<body>
    <!-- <div class="container d-flex justify-content-center">
        <div class="card shadow p-2 w-70 mt-5 mb-5 p-4" style="width: 35rem;">
            <div>
                <h1 class="mb-4">Update status</h1>
            </div>
            <div class="alert alert-<?= $class; ?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($mealError) ?? ''; ?></p>
            </div>
            <a href='home.php'><button class="btn btn-success border rounded" type='button'>Home</button></a>
        </div>
    </div> -->

    <fieldset class="card shadow p-5 w-70 " style="margin-top: 5vh; margin-bottom: 5vh;">
        <form action="" method="post" enctype="multipart/form-data">
            <legend class='h4 mb-3'><strong>Your Meal planner</strong> </legend>
            <h2 style="color:green">When would you like to have your meal?</h2>
            <br>
            <h5>Select a date:<br><br>
                <input class='form-control' type="date" name="date" step="any">
                <input type="hidden" name="recipes_id" value="<?php echo $id ?>" />
                <input type="hidden" name="type" value="<?php echo $row['type'] ?>" />
            </h5>
            <a href="home.php"><button class='btn btn-warning mt-3 me-2' type="button">Back</button></a>
            <button class='btn btn-success mt-3 ' name="submit">Confirm</button>

        </form>
    </fieldset>

</body>

</html>