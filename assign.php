<?php
session_start();
include_once 'include/class.user.php';
$user = new User();

$uid = $_SESSION['uid'];
$myassignid = $_GET['assuid'];

if (!$user->get_session()) {
  header("location:login.php");
}

if (isset($_GET['q'])) {
  $user->user_logout();
  header("location:login.php");
}


?>


<?php
include_once 'include/class.user.php';
$user = new User();

if (isset($_POST['submit'])) {

  extract($_POST);
  $register = $user->assignUpdate($updateid, $assignto, $role_id, $dep_id);
  if ($register) {
    // Registration Success
    echo "<div style='text-align:center;color:green'><h1>Assign successfully! <a href='home.php'>Home</a></h1></div>";
  } else {
    // Registration Failed
    echo "<div style='text-align:center'>Error</div>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Assign </title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>

<body>
  <div id="container" class="container">
    <h1>Assign to Any Employee and Department </h1>
    <form action="" method="post" name="reg">
      <table class="table">
        <input type="hidden" name="updateid" value=" <?php echo $myassignid; ?>" required>

        <tr>
          <th>Assign Under</th>
          <td>
            <?php
            $user->users();

            ?>
          </td>
        </tr>
        <tr>
          <th>Department</th>
          <td>
            <select name="dep_id" required>
              <option value="1">DEPARTMENT-A</option>
              <option value="2">DEPARTMENT-B</option>
              <option value="3">DEPARTMENT-C</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>Role</th>
          <td>
            <select name="role_id" required>
              <option value="1">CEO</option>
              <option value="2">COO</option>
              <option value="3">GENERAL MANAGER</option>
              <option value="4">MANAGER</option>
              <option value="5">SUPERVISOR</option>
              <option value="6">STAFFS</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input class="btn" type="submit" name="submit" value="Assign Confirm">
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><a href="home.php">Back</a></td>
        </tr>

      </table>
    </form>
  </div>

</body>

</html>