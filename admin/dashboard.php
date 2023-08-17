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
               <div class='card'>
                   <img src='{$row["url"]}' class='card-img-top' alt='...'>
                   <div class='card-body'>
                   <h5 class='card-title'>{$row["recipe_name"]}</h5>
                   <p class='card-text'> {$row["prep_time"]}</p>
                   <p class='card-text'> {$row["type"]}</p>
                   <p class='card-text'> {$row["meal_type"]}</p>
                   
                   <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal{$row['recipes_id']}'>Delete
                </button>
                   <a href='../home_user/update_rec.php?id={$row['recipes_id']}' class='btn btn-success'>Update</a>
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

<body>
    <?php require_once '../components/navbar.php' ?>
    <!--  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?= $rowPersons["picture"] ?>" alt="user pic" width="30" height="24">
            </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
          
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href='create.php?id=$row[' recipes_id']' class='btn btn-warning '>Create</a>
                </form>
            </div>
        </div>
    </nav> -->

    <h2 class="text-center">Welcome <?= $rowPersons["fname"] . " " . $rowPersons["lname"] ?></h2>

    <form class="d-flex">
        <a href='create.php?id=$row[' recipes_id']' class='btn btn-warning '>Create</a>
    </form>




    <div class="container">
        <div class="row row-cols-lg-3 ">
            <?php echo $cards; ?>
        </div>
    </div>
    <?php require_once '../components/footer.php' ?>
</body>

</html>