<?php

include 'koneksi.php';

session_start();


    if(!isset($_SESSION['masyarakat'])){

        echo"<script>alert('Tidak bisa akses halaman ini'); </script>";
        echo"<script>document.location.href='login.php'; </script>";

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun</title>

    <!-- favicon -->
    <link rel="icon" href="assets/images/Dinsos.png">

    <!-- loader -->
    <link rel="stylesheet" href="assets/css/pace.min.css">
    <script src="assets/js/pace.min.js"></script>

    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- icon css -->
    <link rel="stylesheet" href="assets/css/icons.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    
</head>
<body>
    
    <div class="wrapper">
        <div class="container align-item-center justify-content-center mt-5">
            <div class="row">
                 <div class="col-8 col-lg-8 mx-auto">
                    <div class="card radius-15">
                        <div class="card-header text-center">
                            <h3 class="mt-4 font-weight-bold">Verifikasi Akun</h3>
                        </div>
                        <div class="card-body p-md-5">
                            <form method="POST">

                            <div class="form-group">
                              <label for="username">Masukkan Kode OTP</label>
                              <br>
                                 <input 
                                     type="text"
                                     maxlength="6" 
                                     class="form-control-lg <?php if (isset($_GET['error'])) { echo 'is-invalid'; } ?>" 
                                     name="kode_otp" 
                                     id="kode_otp" 
                                     placeholder="Contoh : 345xxx" >

                                 <?php if (isset($_GET['error'])) { ?>
                                     <span class="invalid-feedback"><?php echo htmlspecialchars($_GET['error']); ?></span>
                                <?php 
                                 } 
                             ?>
                            </div>

                            <button type="submit" name="verifikasi" class="btn btn-primary">Verifikasi</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Belum dapat kode OTP? <a href="register.php">Kirim ulang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery, Papper -->
<script src="assets/js/jquery.min.js"></script>
</body>
</html>

<?php
    
    if (isset($_POST['verifikasi'])) {
        $kode_otp = $_POST['kode_otp'];

        // Perbaikan query SQL
        $query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE kode_otp = '$kode_otp'") or die(mysqli_error($koneksi));

        $data = $query->fetch_assoc();

        $nik = $_SESSION['nik'];

        if ($kode_otp == $data['kode_otp']) {

            $query_update = mysqli_query($koneksi, "UPDATE masyarakat SET status_verify = 'sudah' WHERE nik = '$nik'")or die(mysqli_error($koneksi));


            echo "<script>alert('Verifikasi Berhasl');</script>";
            echo "<script>location.href='index.php';</script>";

        } else{
            echo "<script>alert('Kode OTP Tidak Berhasil');</script>";
            echo header('location: verifikasi_akun.php?error=Kode OTP tidak sesuai');
        }
    }

?>