<?php

ob_start();
$emailErr = $nameErr =  $passErr = $rpassErr = $roleErr = "";
$email = $name =  $pass = $rpass = $role = "";
$valEmail = $valName = $valPass = $valRole = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // cek format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            require "connect.php";
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["email"] != $email) {
                        $valEmail = true;
                    } else {
                        $emailErr = "Email already exist!";
                        $valEmail = false;
                        break;
                    }
                }
            } else {
                echo "0 results";
            }
            mysqli_close($conn);
        }
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // cek format nama
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        } else {
            $valName = true;
        }
    }

    if (empty($_POST["password"])) {
        $passErr = "Password is requied";
    } else {
        $pass = test_input($_POST["password"]);
    }

    if (empty($_POST["role"])) {
        $roleErr = "Role is requied";
    } else {
        $role = test_input($_POST["role"]);
        $valRole = true;
    }

    if (empty($_POST["rpassword"])) {
        $rpassErr = "Repeat the Password";
    } else {
        $rpass = test_input($_POST["rpassword"]);
    }

    if ($pass != $rpass) {
        $rpassErr = "Repeat password must be the same as password";
    } else {
        $valPass = true;
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

if ($valEmail && $valName && $valPass && $valRole == true) {
    require "connect.php";

    $dc = date("Y-m-d");
    $dm = date("Y-m-d");
    $pass = sha1($pass);

    $sql = "INSERT INTO user (email, name, password, role, created, modified)
    VALUES ('$email', '$name', '$pass', '$role', '$dc', '$dm')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: login.php");
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

    <title>SB Admin - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 text-danger"><?php echo $nameErr; ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo $email; ?>">
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 text-danger"><?php echo $emailErr; ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <select name="role" id="role" class="form-control form-select-lg" value="<?php echo $role; ?>">
                                        <option value="">--Select the Role--</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 text-danger"><?php echo $roleErr; ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo $pass; ?>">
                                    <label for="inputPassword">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" name="rpassword" id="confirmPassword" class="form-control" placeholder="Confirm password" value="<?php echo $rpass; ?>">
                                    <label for="confirmPassword">Confirm password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 text-danger"><?php echo $passErr; ?></div>
                            <div class="col-md-6 text-danger"><?php echo $rpassErr; ?></div>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Register">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="login.html">Login Page</a>
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