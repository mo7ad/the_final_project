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
  <title>Recipe Details</title>
  <link rel="stylesheet" href="../components/details.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <style>
    .section_our_solution .row {
      align-items: center;
    }

    .our_solution_category {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
    }

    .our_solution_category .solution_cards_box {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .solution_cards_box .solution_card {
      flex: 0 50%;
      background: #fff;
      box-shadow: 0 2px 4px 0 rgba(136, 144, 195, 0.2),
        0 5px 15px 0 rgba(37, 44, 97, 0.15);
      border-radius: 15px;
      margin: 8px;
      padding: 10px 15px;
      position: relative;
      z-index: 1;
      overflow: hidden;
      min-height: 600px;
      transition: 0.7s;
    }

    .solution_cards_box .solution_card:hover {
      background: rgb(174, 238, 178);
      background: radial-gradient(circle, rgba(174, 238, 178, 1) 0%, rgba(55, 85, 19, 1) 100%);
      /* color: #fff; */
      transform: scale(1.1);
      z-index: 9;
    }

    .solution_cards_box .solution_card:hover::before {
      background: rgb(85 108 214 / 10%);
    }

    .solution_cards_box .solution_card:hover .solu_title h3,
    .solution_cards_box .solution_card:hover .solu_description p {
      color: #fff;
    }

    .solution_cards_box .solution_card:before {
      content: "";
      position: absolute;
      background: rgb(85 108 214 / 5%);
      width: 170px;
      height: 700px;
      z-index: -1;
      transform: rotate(42deg);
      right: -56px;
      top: -23px;
      border-radius: 35px;
    }

    .wrapper {
      margin-left: 100px;
    }

    .solution_cards_box .solution_card:hover .solu_description button {
      background: #fff !important;
      color: #36F030;
    }

    /* .solution_card .so_top_icon {} */
    .solution_card .solu_title div {
      color: #212121;
      font-size: 1.3rem;
      margin-top: 13px;
      margin-bottom: 13px;
    }

    .solution_card .solu_description p {
      font-size: 15px;
      margin-bottom: 15px;
    }

    .solution_card .solu_description button {
      border: 0;
      border-radius: 15px;
      background: linear-gradient(140deg,
          #42C3CA 0%,
          #42C3CA 50%,
          #42c3cac7 75%) !important;
      color: #fff;
      font-weight: 500;
      font-size: 1rem;
      padding: 5px 16px;
    }

    .our_solution_content div {
      text-transform: capitalize;
      margin-bottom: 1rem;
      font-size: 2.5rem;
    }

    /* .our_solution_content p {} */
    .hover_color_bubble {
      position: absolute;
      background: rgb(54 81 207 / 15%);
      width: 100rem;
      height: 100rem;
      left: 0;
      right: 0;
      z-index: -1;
      top: 16rem;
      border-radius: 50%;
      transform: rotate(-36deg);
      left: -18rem;
      transition: 0.7s;
    }

    .solution_cards_box .solution_card:hover .hover_color_bubble {
      top: 0rem;
    }

    .solution_cards_box .solution_card .so_top_icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: #fff;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .solution_cards_box .solution_card .so_top_icon img {
      width: 40px;
      height: 50px;
      object-fit: contain;
    }

    /*start media query*/
    @media screen and (min-width: 320px) {
      .sol_card_top_3 {
        position: relative;
        top: 0;
      }

      .our_solution_category {
        width: 100%;
        margin: 0 auto;
      }

      .our_solution_category .solution_cards_box {
        flex: auto;
      }
    }

    @media only screen and (min-width: 768px) {
      .our_solution_category .solution_cards_box {
        flex: 1;
      }
    }

    @media only screen and (min-width: 1024px) {
      .sol_card_top_3 {
        position: relative;
        top: -3rem;
      }

      .our_solution_category {
        width: 80%;
        margin: 0 auto;
      }
    }

    .col-lg-8 {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .h3_class {
      margin-top: 0px;
      margin-left: 15px;
      color: black;
    }
  </style>
</head>

<body>
  <?php if (isset($_SESSION["admin"])) {
    require_once '../components/admin_navbar.php';
  } else {
    require_once '../components/navbar.php';
  }
  ?>


  <div class="section_our_solution d-flex justify-content-center text-align-center my-3">
    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-6 ">
        <div class="our_solution_category">
          <div class="solution_cards_box">
            <div class="solution_card ">
              <div class="hover_color_bubble"></div>
              <!-- Insert your existing recipe details code here -->
              <div class="wrapper">
                <div class="product-img">
                  <img src="<?php echo $row["url"]; ?>" height="452px" width="327px">
                </div>
                <div class="product-info">
                  <div class="product-text">
                    <h1 class="text-center pe-5"><strong><?php echo $row["recipe_name"]; ?></strong></h1>
                    </h1>
                    <h5 class="h3_class"><strong>Ingredients:</strong><br>
                      <?php
                      $ingredients = $row["ingredients"];
                      $ingredientsWithLink = preg_replace(
                        '/(https?:\/\/\S+)/i',
                        '<a href="$1" target="_blank">Click here</a>',
                        $ingredients
                      );
                      echo $ingredientsWithLink;
                      ?>
                    </h5>


                    <h5 class="h3_class "><strong>Description:</strong><br><?php echo $row["description"]; ?></h5>
                    <h5 class="h3_class "><strong>Diet:</strong><br> <?php echo $row["type"]; ?></strong></h3>
                      <h5 class="h3_class "><strong>Type:</strong><br> <?php echo $row["meal_type"]; ?></h5>
                      <h5 class="h3_class "><strong>Minutes:</strong><br> <?php echo $row["prep_time"]; ?> min</h5>
                      <h5 class="h3_class "><strong>Calories:</strong><br> <?php echo $row["calories"]; ?> kcal</h5>
                      <?php
                      if (isset($_SESSION["admin"])) {
                        echo "<a href='../admin/recipes.php' class='btn btn-outline-secondary ms-3 mt-2'>Go Back</a>";
                      } elseif (isset($_SESSION["user"])) {
                        echo " <a href='home.php' class='btn btn-outline-secondary ms-3 mt-2'>Go Back</a>";
                      }
                      ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <?php require_once '../components/footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>