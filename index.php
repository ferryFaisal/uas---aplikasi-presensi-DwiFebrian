<?php
session_start();
if (isset($_SESSION['login'])) {
  require "admin/connect.php";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl = $_POST['tgl'];
    $makul = $_POST['makul'];
    $kelas = $_POST['kelas'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $presensi = $_POST['presensi'];

    if (isset($_POST['submit'])) {
      $sql = "insert into presensi values";
      for ($i = 0; $i < count($nama); $i++) {
        $sql .= "('$tgl', '$makul', '$kelas', '{$nim[$i]}', '{$nama[$i]}', '{$presensi[$i]}'),";
      }
      $sql = rtrim($sql, ',');
      mysqli_query($conn, $sql);
    }
  }
?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input | Presensi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>

  <body class="bg-dark">
    <h1></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header text-center">
          <h4>Pengisian Kehadiran Mahasiswa</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="">
            <!-- <div class="form-group"> -->
            <div class="row form-row mb-3">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="date" id="tgl" name="tgl" class="form-control" placeholder="Tgl" autofocus="autofocus" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <select name="makul" id="makul" class="form-control" autofocus="autofocus">
                    <option value=""> -- Pilih Mata Kuliah -- </option>
                    <option value="WebProg"> Pemrograman Web </option>
                    <option value="WebProgLab"> Praktik Pemrograman Web </option>
                    <option value="SoftDev"> Rekayasa Perangkat Lunak </option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <select name="kelas" id="kelas" class="form-control" autofocus="autofocus">
                    <option value=""> -- Pilih Kelas -- </option>
                    <option value="5A"> 5A </option>
                    <option value="5B"> 5B </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-row mb-3">
              <div class="col-md-12">
                <button class="btn btn-primary" type="submit" name="select">Select!</button>
              </div>
            </div>
            <hr>
            <div class="row text-center">
              <div class="col-md-4"><strong>Nomor Induk Mahasiswa</strong></div>
              <div class="col-md-4"><strong>Nama Lengkap</strong></div>
              <div class="col-md-4"><strong>Status Presensi</strong></div>
            </div>
            <hr>

            <?php
            if (isset($_POST['select'])) {
              if ($_POST['kelas'] == '5A') {
                $sql = "SELECT * FROM mahasiswa where kelas = '5A' ";
                $result = mysqli_query($conn, $sql);
              }
              if ($_POST['kelas'] == '5B') {
                $sql = "SELECT * FROM mahasiswa where kelas = '5B' ";
                $result = mysqli_query($conn, $sql);
              }
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="row form-row mb-1">
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <input type="text" id="nim" name="nim[]" class="form-control" placeholder="NIM" autofocus="autofocus" value="<?php echo $row["nim"] ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <input type="text" id="nama" name="nama[]" class="form-control" placeholder="Nama" autofocus="autofocus" value="<?php echo $row["nama"] ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group">
                      <select name="presensi[]" id="presensi" class="form-control" autofocus="autofocus">
                        <option value="Hadir"> Hadir </option>
                        <option value="Sakit"> Sakit </option>
                        <option value="Izin"> Izin </option>
                        <option value="Alpa"> Alpa </option>
                      </select>
                    </div>
                  </div>
                </div>
            <?php
              }
            } else {
              echo "Pilih kelas terlebih dahulu!";
            }
            ?>


            <!-- </div> -->
            <br>
            <p class="text-center">
              <input type="submit" name="submit" value="Simpan Presensi" class="btn btn-primary btn-block">
            </p>
            <!-- <a class="btn btn-secondary btn-block" href="users.php">Cancel</a> -->
          </form>
          <div class="text-center">
            <br>Copyright © Program Studi Teknik Informatika - <?= date('Y'); ?><br>
          </div>
        </div>
      </div>

  </body>

  </html>
<?php
} else {
  echo "You can't access this page before you login!";
  echo "<br>";
  echo "<a href='login.php'>Login here...</a>";
}
?>