<?php
include_once 'include/class.user.php';
$user = new User();
if (isset($_POST['submit'])) {
  extract($_POST);
  $register = $user->reg_user($fullname, $uname, $upass, $uemail, $role_id, $dep_id);
  if ($register) {
    // Registration Success
    echo "<div style='text-align:center;color:green'><h1>Registration successful <a href='login.php'>Click here</a> to login</h1></div>";
  } else {
    // Registration Failed
    echo "<div style='text-align:center;color:red'><h1>Registration failed. Email or Username already exits please try again.</h1></div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>

<body>
  <div id="container" class="container">
    <h1>Registration Here</h1>
    <form action="" method="post" name="reg">
      <table class="table">
        <tr>
          <th>Full Name:</th>
          <td>
            <input type="text" name="fullname" required>
          </td>
        </tr>
        <tr>
          <th>User Name:</th>
          <td>
            <input type="text" name="uname" required>
          </td>
        </tr>
        <tr>
          <th>Email:</th>
          <td>
            <input type="email" name="uemail" required>
          </td>
        </tr>
        <tr>
          <th>Password:</th>
          <td>
            <input type="password" name="upass" required>
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
            <input class="btn" type="submit" name="submit" value="Register" onclick="return(submitreg());">
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><a href="login.php">Already registered? Click Here!</a></td>
        </tr>

      </table>
    </form>
  </div>

  <script>
    function submitreg() {
      var form = document.reg;
      if (form.name.value == "") {
        alert("Enter name.");
        return false;
      } else if (form.uname.value == "") {
        alert("Enter username.");
        return false;
      } else if (form.upass.value == "") {
        alert("Enter password.");
        return false;
      } else if (form.uemail.value == "") {
        alert("Enter email.");
        return false;
      }
    }
  </script>
</body>

</html>