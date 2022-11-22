<?php
session_start();
// proses validasi inputan user
$emailErr = $passErr = "";
$email = $pass = "";
$valEmail = $valPass = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require "connect.php";
  $email = ($_POST["email"]);
  $sql = "SELECT * FROM user where email = '$email'";
  $result = mysqli_query($conn, $sql);
  $cnt = mysqli_fetch_assoc($result);
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row["email"] != $email) {
          $valEmail = false;
          $emailErr = "Email is wrong!";
        } else {
          $valEmail = true;
          break;
        }
      }
    } else {
      echo "0 results";
    }
  }

  if (empty($_POST["password"])) {
    $passErr = "Password is required";
  } else {
    $pass = sha1(test_input($_POST["password"]));
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row["password"] != $pass) {
          $valPass = false;
          $passErr = "Password is wrong!";
        } else {
          $valPass = true;
          break;
        }
      }
    } else {
      echo "0 results";
    }
    mysqli_close($conn);
  }
}

// fungsi sanitasi
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['login'])) {
  if ($valEmail && $valPass == true) {
    switch ($cnt['role']) {
      case 'dosen':
        $_SESSION['login'] = $email;
        $_SESSION['name'] = $cnt['name'];
        $_SESSION['role'] = $cnt['role'];
        header("Location: ../index.php");
        break;
      case 'admin':
        $_SESSION['login'] = $email;
        $_SESSION['name'] = $cnt['name'];
        $_SESSION['role'] = $cnt['role'];
        header("Location: index.php");
        break;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
            <div class="form-row">
              <div class="col-md-6 text-danger"><?php echo $emailErr; ?></div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
              <label for="inputPassword">Password</label>
            </div>
            <div class="form-row">
              <div class="col-md-6 text-danger"><?php echo $passErr; ?></div>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" name="login" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>