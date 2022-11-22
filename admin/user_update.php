<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['role'] == 'admin') {
    require 'connect.php';

    ob_start();
    $nameErr =  $passErr = $roleErr = "";
    $nName =  $nPass = $role = "";
    $valName = $valPass = $valRole = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $nName = ($_POST["name"]);
            // cek format nama
            if (!preg_match("/^[a-zA-Z-' ]*$/", $nName)) {
                $nameErr = "Only letters and white space allowed";
            } else {
                $valName = true;
            }
        }

        if (empty($_POST["password"])) {
            $passErr = "Password is requied";
        } else {
            $nPass = ($_POST["password"]);
            $valPass = true;
        }

        if (empty($_POST["role"])) {
            $roleErr = "Role is requied";
        } else {
            $role = ($_POST["role"]);
            $valRole = true;
        }
    }

    $sql = "SELECT * FROM user where email = '$_GET[email]'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sDosen = $sAdmin = "";
            switch ($row['role']) {
                case "dosen":
                    $sDosen = "selected";
                    break;
                case "admin":
                    $sAdmin = "selected";
                    break;
            }
            $email = $_GET['email'];
            $name = $row['name'];
            $pass = $row['password'];
        }
    }

    if (isset($_POST['submit'])) {
        if ($valName && $valPass && $valRole == true) {
            require "connect.php";
            $dm = date("Y-m-d");
            $pass = sha1($pass);

            $sql = "UPDATE user SET name = '$nName', password = '$nPass', role = '$role', modified = '$dm'
            where email = '$email'";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
            header("Location: user.php");
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

        <title>SB Admin - Blank Page</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

            <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Search -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span class="badge badge-danger">9+</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-danger">7</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </li>
            </ul>

        </nav>

        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="sidebar navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mahasiswa.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="presensi.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Presensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
            <div id="content-wrapper">

                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Update Presensi</li>
                    </ol>
                    <!-- Page Content -->
                    <h1>Update Presensi</h1>
                    <hr>
                    <div class="container">
                        <div class="card card-register mx-auto mt-5">
                            <div class="card-header">User Form</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <input type="text" name="name" id="lname" class="form-control" placeholder="Last Name" value="<?php echo $name; ?>">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $nameErr; ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo $pass; ?>">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $passErr; ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-label-group">
                                                    <select name="role" id="role" class="form-control form-select-lg" value="<?php echo $role; ?>">
                                                        <option value="">--Select the Role--</option>
                                                        <option value="dosen" <?php echo $sDosen ?>>Dosen</option>
                                                        <option value="admin" <?php echo $sAdmin ?>>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $roleErr; ?></div>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                    <div class="form-label-group">
                      <input type="file" name="photo" id="photo" class="form-control" placeholder="Photo" value="<?php echo $photo; ?>">
                      <label for="photo">Select Photo</label>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6 text-danger"><?php echo $photoErr; ?></div>
                    </div>
                  </div> -->
                                    <!-- <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-label-group">
                        <select name="role" id="role" class="form-control form-select-lg">
                          <option value="">--Select the Role--</option>
                          <option>Owner</option>
                          <option>Sales</option>
                          <option>Finance</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 text-danger"></div>
                  </div>
                </div> -->
                                    <!-- <div class="form-group">
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
                    <div class="col-md-6 text-danger"></div>
                    <div class="col-md-6 text-danger"></div>
                  </div>
                </div> -->
                                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Update User">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Your Website 2019</span>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin.min.js"></script>

    </body>

    </html>
<?php

} else {
    echo "You can't access this page before you login!";
    echo "<br>";
    echo "<a href='login.php'>Login here...</a>";
}
?>