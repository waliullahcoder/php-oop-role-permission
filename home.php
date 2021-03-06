<?php
session_start();
include_once 'include/class.user.php';
$user = new User();

$uid = $_SESSION['uid'];

if (!$user->get_session()) {
  header("location:login.php");
}

if (isset($_GET['q'])) {
  $user->user_logout();
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>

<body>


  <div id="container" class="container">
    <div id="header">
      <a href="home.php?q=logout">
        <h1>LOGOUT</h1>
      </a>
    </div>
    <div id="main-body">
      <br />
      <br />
      <br />
      <br />

      <?php $user->get_fullname($uid); ?>

    </div>
    <div id="footer"></div>
  </div>
</body>

</html>