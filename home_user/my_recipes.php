<?php
session_start();
require_once '../components/db_connect.php';

// if adm will redirect to dashboard

if (isset($_SESSION['admin'])) {
    header("Location: ../admin/dashboard_users.php");
    exit;
}

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['user'])) {
    $val = $_SESSION['user'];
};

// echo ($result);
// exit;

$sql = "SELECT * FROM recipes
JOIN users ON recipes.fk_user_id = users.user_id
WHERE users.user_id = $val and recipes.verified = 'verified'";
$result = mysqli_query($connect, $sql);
$tbody = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tbody .= "<div class='col-md-4 mb-4'>
        <div class='card h-100 shadow''>
            <img src='" . $row['url'] . "' class='card-img-top' style='object-fit: cover; height: 320px; width:100%;' alt='" . $row['recipe_name'] . "'>
            <div class='card-body'>
                <h4 class='card-title text-center'><i>" . $row['recipe_name'] . "</i></h5>
                    <div class='card-body'>
                        <ul class='list-unstyled mb-3'>
                            <li class='text-center'><strong>Meal type:</strong> " . $row['meal_type'] . " </li>
                            <li class='text-center'><strong>Preparation time:</strong> " . $row['prep_time'] . "   </li>
                            <li class='text-center'><strong>Calories</strong>: " . $row['calories'] . "   </li>
                            <li class='text-center'><strong>Type:</strong> " . $row['type'] . "   </li>
                        </ul>
                    </div>
            <div class='d-flex justify-content-center align-items-center'>
            <span>" . "<a href='details.php?id=" . $row['recipes_id'] . "'><button class='btn btn-outline-success cardbtn ' type='button'><span class='text-nowrap'>More Info</span></button></a></span>
            <a href='update_rec.php?id=" . $row['recipes_id'] . "'><button class='btn btn-outline-warning cardbtn mx-2' type='button'><span class='text-nowrap'>Update</span></button></a>
            <a href='delete_rec.php?id=" . $row['recipes_id'] . "'><button class='btn btn-outline-danger cardbtn' type='button'><span class='text-nowrap'>Delete</span></button></a>
            </div>
            </div>
            </div>
        </div>";
    };
} else {
    $tbody =  "<tr><td colspan='8'><center>No Data Available</center></td></tr>";
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/style.css">
    <title>Home</title>

    <script src="https://kit.fontawesome.com/34a8e65dca.js" crossorigin="anonymous"></script>
    <?php require_once '../components/bootstrap.php' ?>
    <style>
        /* Add the sliding text animation styles here */
        .sliding-text-container {
            position: relative;
            width: 100%;
            height: 130px;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0);
        }

        .sliding-text {
            position: absolute;
            top: 10%;
            left: 0;
            transform: translateY(-50%);
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 2em;
            animation: slide-up 8s linear infinite;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            transition: transform 1.5s ease;
        }

        .card {
            transition: opacity 0.3s;
            /* Add smooth transition effect */
        }

        .card:hover {
            opacity: 0.5;
            /* transform: rotateY(360deg); */
            /* Adjust the angle as needed */
        }


        .shake:hover {
            animation: shake 0.3s linear infinite;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(5px);
            }
        }
    </style>
</head>

<body>
    <?php require_once '../components/navbar.php' ?>

    <div class="px-4 py-5 mb-5 text-center bordered shadow" style="background-image: url(https://images.pexels.com/photos/5202219/pexels-photo-5202219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
            background-size: cover;">
        <div class="transparent-bg" style="background-color: rgba(255, 255, 255, 0.1);padding: 10px; display: inline-block; border-radius: 100px; ">
            <h1 style="text-shadow: 2px 2px 2px white; letter-spacing: 4px; font-size: 55px;" class="display-5 fw-bold mt-4">MealPlanner menu</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="text-shadow: 2px 2px 4px white; letter-spacing: 4px; font-size: 30px; background-color: #e6e7eb63;border-radius: 80px;font-weight: lighter;">Choose your favourite dishes and organize your day!</p>
            </div>
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
        <a href="#cards"><svg id="arrow" xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg></a>
    </div>
    <!-- arro====== -->

    <div class="container">
        <div class='row row-cols-lg-3'>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </div>
    </div>
    <div class="footer">
        <?php require_once '../components/footer.php' ?>
    </div>


    <!-- up button  -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class="fa-solid fa-arrow-up fa-bounce"></i>
    </button>

    <script>
        // Get the button
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script src="https://kit.fontawesome.com/02a86c689a.js" crossorigin="anonymous"></script>
    <script src="../components/count.js"></script>
</body>

</html>