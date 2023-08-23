<?php 
    session_start();
    require_once "../db_connect.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM recipes WHERE recipes_id = $id ";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

     
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../components/details.css">
</head>
<body>
<html lang="en">

<head>
  <title>Harvest vase</title>
  <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
</head>

<body>
<?php require_once '../components/navbar.php' ?>
  <div class="wrapper">
    <div class="product-img">
      <img src="<?php echo $row["url"]; ?>" height="500" width="327">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1><?php echo $row["recipe_name"]; ?></h1>
        <p><?php echo $row["ingredients"]; ?></p>
        <p><?php echo $row["description"]; ?></p>
        <h1>Diet: <?php echo $row["type"]; ?></h1>
        
        <h1>Type: <?php echo $row["meal_type"]; ?></h1>
        
        <h1>Minutes: <?php echo $row["prep_time"]; ?></h1>
        
        <h1>Calories: <?php echo $row["calories"]; ?></h1>
        <br>
        <br>
        <?php
            if (isset($_SESSION["admin"])) {
              echo "<a href='../admin/recipes.php' class='btn btn-outline-warning mx-3'>Go Back</a>";
            } elseif (isset($_SESSION["user"])) {
              echo " <a href='home.php' class='btn btn-outline-warning mx-3'>Go Back</a>";
            }
            ?>


        
      </div>
      
      
    </div>
  </div>
  <div class="footer">
        <?php require_once '../components/footer.php' ?>

</body>

</html>
</body>
</html>