<?php
// session_start();

require_once "../db_connect.php";

// if (isset($_SESSION['user'])) {
//     $user_id = $_SESSION['user'];

//     //  $_SESSION["user"]=$user_id;

//     $sqlPersons = "SELECT * FROM `users` WHERE user_id = $user_id";
//     $resultPersons = mysqli_query($connect, $sqlPersons);
//     $rowPersons = mysqli_fetch_assoc($resultPersons);


//     $sql = "SELECT * FROM `recipes` WHERE fk_user_id = '$user_id'";
//     $result = mysqli_query($connect, $sql);
// } else {
//     header("Location: ../login/login.php");
//     exit;
// }

// $cards = "";

// if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {

//         $cards .= "<div class='row-md-4 mb-4'>
//         <div class='card h-100 shadow'>
//             <img src='" . $row['url'] . "' class='card-img-top' style='object-fit: cover; height: 200px;' alt='" . $row['recipe_name'] . "'>
//             <div class='card-body'>
//                 <h4 class='card-title text-center'><i>" . $row['recipe_name'] . "</i></h4>
//                 <ul class='list-unstyled mb-3'>
//                     <li><strong>Type:</strong> " . $row['type'] . "</li>
//                     <li><strong>Preparation time:</strong> " . $row['prep_time'] . "</li>
//                     <li><strong>Calories:</strong> " . $row['calories'] . "</li>
//                     <li><strong>Diet:</strong> " . $row['meal_type'] . "</li>
//                 </ul>
//                 <div class='d-flex justify-content-center'>
//                      <a href='details.php?id=" . $row['recipes_id'] . "' class='btn btn-success btn-sm mr-2 mx-2' role='button'>More Info</a>
//                 </div>
//             </div>
//         </div>
//     </div>";
//     }
// } else {
//     $cards = "<p>No results found!</p>";
// }


// 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&display=swap" rel="stylesheet">
    <title>Welcome <?php echo $rowPersons["fname"]; ?></title>

    <?php require_once '../components/bootstrap.php' ?>

</head>

<body>
    <?php require_once '../components/index.nav.php' ?>

    <div class="px-4 py-5 mb-5  text-center bordered shadow" style="background-image: url('https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');   object-fit: cover; background-repeat:no-repeat; background-size: cover;">
        <div class="transparent-bg" style="background-color: rgba(255, 255, 255, 0.1);padding: 10px; display: inline-block; border-radius: 100px; ">
            <h1 class="display-5 fw-bold mt-4 ">MealPlanner menu</h1>
            <div class="col-lg-6 mx-auto">
            </div>
            <p class="lead mb-4  ">Choose your favourite dishes and organize your day!</p>
            <div class="d-grid gap-2 d-flex justify-content-center">

                <form method="POST" action="filter.php">
                    <select name="category" class="ps-4 pe-4 p-3 rounded shadow" style="background-color: #E6E7EB">
                        <option value="#">Your personal filter: </option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="high-protein">vegan</option>
                        <option value="regular">Normal</option>
                        <option value="vegetarian">Vegetarian</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-md mt-2" name="filter">Look for it!</button>
                </form>
            </div>
        </div>
    </div>

    <!-- arro====== -->
    <div class="arrow">
        <a href="#footer"><svg id="arrow" xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg></a>
    </div>
    <!-- arro====== -->
    <div class="container section">
        <h1 class="site-logo title is-1 megatitle" style="font-family:'Cabin Sketch', cursive;color:#007444;font-weight:bold;text-align:center;"> Meal Planning Made Easy </h1>
        <p>A magical new way to plan your meals. Groundbreaking organizing features designed to save time, customize your weekly meal plan based on your diet and eating habits. An innovative meal planning in 3 steps for mind-blowing simplicity. All powered by our ultimate 3000+ recipes database.</p>
        <h6>Easy to use. Anywhere. Anytime.</h6>
        <div class="icons">
            <div>
                <img width="100" src="https://www.eatwell101.com/wp-content/plugins/eric-meal-planner/assets/images/meal.jpg" alt="">
                <p><span class="circle">1</span> Choose Your Meals</p>
            </div>
            <div>
                <img width="100" src="https://www.eatwell101.com/wp-content/plugins/eric-meal-planner/assets/images/phone.jpg" alt="">
                <p><span class="circle">2</span> Add To The Meal Planner</p>
            </div>
            <div>
                <img width="100" src="https://www.eatwell101.com/wp-content/plugins/eric-meal-planner/assets/images/bag.jpg" alt="">
                <p><span class="circle">3</span> Save Your Meal Plan</p>
            </div>
        </div>
    </div> 
    <!--start Services-->
    <div class="Services pt-5 mt-3 text-center" style="background-color: #E7E6DC;">
        <h2 class="fs-2 fw-bold text-capitalize">Services</h2>
        <p class="text-black-50">In order to help you grow your business, our carefully selected experts can advise you in the
            following areas:</p>
        <div class="row container m-auto pt-5">
            <div class="col-lg-4 col-sm-12 mb-5">
                <div class="fs-2 mb-4 h-design">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: hsl(43, 69%, 45%)
                            }
                        </style>
                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                    </svg>

                    <h2 class="fs-2 fw-bold text-capitalize">Plan Your Eat</h2>
                </div>
                <p class="text-black-50">"Plan Your Eat" is a concept that encourages thoughtful and deliberate meal planning. It involves considering your nutritional needs, dietary preferences, and schedule to create a well-rounded and satisfying meal plan. By planning your meals</p>
            </div>
            <div class="col-lg-4 col-sm-12 mb-5">
                <div class="fs-2 mb-4 h-web">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: #13135d
                            }
                        </style>
                        <path d="M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z" />
                    </svg>
                    <h2 class="fs-2 fw-bold text-capitalize">Recipes</h2>
                </div>
                <p class="text-black-50">Recipes are detailed instructions that guide you through the process of preparing a specific dish or meal. They include a list of ingredients, cooking methods, and step-by-step directions.</p>
            </div>
            <div class="col-lg-4 col-sm-12 mb-5">
                <!--<i class="fa-solid fa-code mb-2 "></i>-->
                <div class="fs-2 mb-4 h-seo">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <style>
                            svg {
                                fill: black
                            }
                        </style>
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                    <h2 class="fs-2 fw-bold text-capitalize">Meal Planner</h2>
                </div>
                <p class="text-black-50">A meal planner is a tool that helps you organize and manage your daily or weekly meals. It allows you to plan and schedule your breakfasts, lunches, dinners, and snacks in advance. With a meal planner, </p>
            </div>
        </div>
    </div>
    <!-- ////// -->
    <!--start counter-->
    <div class="counter p-5 pb-5 text-center" id="counter-section">
        <div class="row container m-auto">
            <div class="col ">
                <span class=" fs-1 fw-bold mb-3 num" data-goal="260">1500</span>
                <h3 style="color: #335b19;" class="fs-1  mb-3">plans</h3>
            </div>
            <div class="col breaks position-relative ">
                <span class=" fs-1 fw-bold mb-3 num " data-goal="120">1200</span>
                <h3 style="color: #335b19;" class="fs-1  mb-3">client</h3>
            </div>
            <div class="col ">
                <span class=" fs-1 fw-bold mb-3 num" data-goal="260">2500</span>
                <h3 style="color: #335b19;" class="fs-1  mb-3">coffes</h3>
            </div>
        </div>
    </div>
    <!--end counter-->

    <div class="container">
        <div class="row row-cols-lg-3 ">
            <!-- <?php echo $cards; ?> -->
        </div>
    </div>
    <div id="footer" class="footer">
        <?php require_once '../components/footer.php' ?>

    </div>
    <script src="../components/count.js"></script>
</body>

</html>