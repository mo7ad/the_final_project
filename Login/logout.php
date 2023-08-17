
<?php
session_start();
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
  header("Location: ../home_user/index.php");
  exit;
} else if (isset($_SESSION['user']) != "") {
  header("Location: ../Login/login.php");
} else if (isset($_SESSION['admin']) != "") {
  header("Location: ../Login/login.php");
}

if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  unset($_SESSION['admin']);
  session_unset();
  session_destroy();
  header("Location: ../Login/login.php");
  exit;
}
