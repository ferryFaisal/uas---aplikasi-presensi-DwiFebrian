<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['role'] == 'admin') {

    ob_start();


    // proses validasi inputan user
    $nimErr = $namaErr = $kelasErr = "";
    $nim = $nama = $kelas = "";
    $valNim = $valNama = $valKelas = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nim"])) {
          $nimErr = "NIM is required";
        } else {
          $nim = ($_POST["nim"]);
          $valNim = true;
        }
        if (empty($_POST["nama"])) {
          $namaErr = "Nama is required";
        } else {
          $nama = ($_POST["nama"]);
          $valNama = true;
        }
        if (empty($_POST["kelas"])) {
          $kelasErr = "Kelas is required";
        } else {
          $kelas = ($_POST["kelas"]);
          $valKelas = true;
        }
    }

    if ($valNim && $valNama && $valKelas == true) {
        require "connect.php";


        $sql = "INSERT INTO mahasiswa (nim, nama, kelas)
VALUES ('$nim', '$nama', '$kelas')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: add_mahasiswa.php");
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
                        <li class="breadcrumb-item active">Add Mahasiswa</li>
                    </ol>
                    <!-- Page Content -->
                    <h1>Add Mahasiswa</h1>
                    <hr>
                    <div class="container">
                        <div class="card card-register mx-auto mt-5">
                            <div class="card-header">User Form</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM" value="<?php echo $nim; ?>">
                                            <label for="nim">NIM</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $nimErr; ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="<?php echo $nama; ?>">
                                            <label for="nama">Nama</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $namaErr; ?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas" value="<?php echo $kelas; ?>">
                                            <label for="kelas">Kelas</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 text-danger"><?php echo $kelasErr; ?></div>
                                        </div>
                                    </div>

                                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Register">
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