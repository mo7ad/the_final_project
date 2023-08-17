<?php 
 
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
      <img src="<?php echo $row["url"]; ?>" height="420" width="327">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1><?php echo $row["recipe_name"]; ?></h1>
        <p><?php echo $row["ingredients"]; ?></p>
        <p><?php echo $row["description"]; ?></p>
      </div>
      <div class="product-price-btn">
        <p><span><p><?php echo $row["calories"]; ?><br><?php echo $row["prep_time"]; ?></p></span></p>
        
        
      </div>
      
    </div>
  </div>
  <div class="footer">
        <?php require_once '../components/footer.php' ?>

</body>

</html>
</body>
</html>