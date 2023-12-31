<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amazing Navbar</title>
  
  <style>
    /* Custom styling for the navbar */
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #343a40;
      animation: slideDown 0.5s ease-in-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .navbar-brand {
      color: #ffffff;
      font-size: 24px;
      font-weight: bold;
    }

    .navbar-toggler-icon {
      background-color: #ffffff;
    }

    .navbar-nav {
      margin-left: auto;
      display: flex;
      align-items: center;
    }

    .navbar-nav .nav-item .nav-link {
      color: #ffffff;
      font-weight: 500;
      transition: color 0.8s ease-in-out;
      margin: 0 15px;
      text-align: center;
    }

    .navbar-nav .nav-item .nav-link:hover {
      color: green;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <img style="width: 60px;" src="https://dq7axd795mydj.cloudfront.net/bots/bucks/assets/avatar-bg-transparent.png" alt="">
      <a class="navbar-brand" href="#">Meal Planner</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../home_user/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home_user/my_recipes.php">My recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home_user/meal_planner.php">Meal Planner</a>
          </li>
          <li class="nav-item">
            <?php
            if (isset($_SESSION["admin"])) {
              echo "<a class='nav-link' href='../admin/create_rec.php?id={$_SESSION['admin']}'>Create Recipes</a>";
            } elseif (isset($_SESSION["user"])) {
              echo " <a class='nav-link' href='../home_user/create_rec.php?id={$_SESSION['user']}'>Create Recipes</a>";
            }
            ?>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="../Login/login.php">Login</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="../Login/logout.php?logout">Logout</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="../Login/register.php">Sign Up</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  
</body>

</html>