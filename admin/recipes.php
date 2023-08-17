<?php
require_once "../db_connect.php";


session_start();
if (isset($_SESSION["user"])) {
    header("location: ../home_user/home.php");
    exit();
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("location: ../login/login.php");
    exit();
}

$sqlPersons = "SELECT * FROM `users`";
$resultPersons = mysqli_query($connect, $sqlPersons);
$rowPersons = mysqli_fetch_assoc($resultPersons);


$sql = "SELECT * FROM `recipes`";
$result = mysqli_query($connect, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cards .= "<div>
               <div class='card card_recipe m-2 mb-5'>
                   <img src='{$row["url"]}' class='card-img-top' alt='...' style='height: 340px; object-fit: cover;'>
                   <div class='card-body'>
                   <h5 class='card-title'>{$row["recipe_name"]}</h5>
                   <p class='card-text'> {$row["prep_time"]}</p>
                   <p class='card-text'> {$row["type"]}</p>
                   <p class='card-text'> {$row["meal_type"]}</p>
                   
                   <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal{$row['recipes_id']}'>Delete
                </button>
                   <a href='../home_user/update.php?id={$row['recipes_id']}' class='btn btn-success'>Update</a>
                   <a href='../home_user/details.php?id={$row['recipes_id']}' class='btn btn-success'>Details</a>
                   </div>
           </div>
         </div>
         <!-- Button trigger modal -->


<!-- Modal -->
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
        <a href='delete.php?id={$row['recipes_id']}' class='btn btn-danger'>YES</a>
        </div>
        </div>
        </div>
        </div>";
    }
} else {
    $cards = "<p>No results found</p>";
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
    <?php require_once '../components/navbar.php' ?>

    <h2 class="text-center text_1 my-5">Welcome <?= $rowPersons["fname"] . " " . $rowPersons["lname"] ?></h2>

    <div class="container">
        <div class="row row-cols-lg-3 ">
            <?php echo $cards; ?>
        </div>
    </div>

    <div class="footer">
        <?php require_once '../components/footer.php' ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>