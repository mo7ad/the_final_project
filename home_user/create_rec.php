<?php
   

    require_once "../db_connect.php";

    if(isset($_POST ["create"])){
        $recipe_name = $_POST ["recipe_name"];
        $description = $_POST ["description"];
        $prep_time = $_POST ["prep_time"];
        $calories= $_POST ["calories"];
        $type = $_POST ["type"];
        $url = $_POST ["url"];
        $meal_type = $_POST ["meal_type"];
        $ingredients = $_POST ["ingredients"];
        

        $sql = "INSERT INTO recipes (recipe_name,description,prep_time,calories,type,url,meal_type,ingredients) VALUES ('$recipe_name','$description','$prep_time','$calories','$type','$url','$meal_type','$ingredients')";

        if(mysqli_query($connect, $sql)){
            echo "success";
            header("refresh: 3; url = home.php");
        }else {
            echo "failed";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
</head>
<body>
<div class="container">

<form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>


<legend>Create your own recipe!</legend>



<div class="form-group">
<label class="col-md-4 control-label">Recipe</label>  
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input  name="recipe_name" placeholder="Recipe" class="form-control"  type="text">
</div>
</div>
</div>



<div class="form-group">
<label class="col-md-4 control-label" >Preparation Time</label> 
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="prep_time" placeholder="XX hours/minutes" class="form-control"  type="text">
</div>
</div>
</div>


   <div class="form-group">
<label class="col-md-4 control-label">Calories</label>  
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
<input name="calories" placeholder="XXXX calories" class="form-control"  type="text">
</div>
</div>
</div>


<!-- Text input-->
   
<div class="form-group">
<label class="col-md-4 control-label">Picture</label>
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
      <textarea class="form-control" name="url" placeholder="Picture link"></textarea>
</div>
</div>
</div>



<div class="form-group"> 
<label class="col-md-4 control-label">Meal time</label>
<div class="col-md-4 selectContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
<select name="meal_type" class="form-control selectpicker" >
  <option value=" " >Please select your meal time</option>
  <option>Breakfest</option>
  <option>Lunch</option>
  <option>Dinner</option>
</select>
</div>
</div>
</div>



<div class="form-group"> 
<label class="col-md-4 control-label">Meal type</label>
<div class="col-md-4 selectContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
<select name="type" class="form-control selectpicker" >
  <option value=" " >Please select your food type</option>
  <option>Vegan</option>
  <option>Vegeterian</option>
  <option>Normal</option>
</select>
</div>
</div>
</div>



<div class="form-group">
<label class="col-md-4 control-label">Ingredients</label>
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
      <textarea class="form-control" name="ingredients" placeholder="Ingredients"></textarea>
</div>
</div>
</div>



<div class="form-group">
<label class="col-md-4 control-label">Preparation description</label>
<div class="col-md-4 inputGroupContainer">
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
      <textarea class="form-control" name="description" placeholder="Project Description"></textarea>
</div>
</div>
</div>


<div class="form-group">
<label class="col-md-4 control-label"></label>
<div class="col-md-4">
<button type="submit" class="btn btn-warning" name="create" >Send <span class="glyphicon glyphicon-send"></span></button>
</div>
</div>

</fieldset>
</form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>