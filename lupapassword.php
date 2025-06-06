<?php

include 'koneksi.php';

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun Lapor Kebencanaan</title>

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
                            <h3 class="mt-4 font-weight-bold">Riset Password</h3>
                        </div>
                        <div class="card-body p-md-5">
                            <form method="POST">

                            <div class="form-group">
                              <label for="username">Masukan Username Anda</label>
                                 <input 
                                     type="text" 
                                     class="form-control <?php if (isset($_GET['errorusername'])) { echo 'is-invalid'; } ?>" 
                                     name="username" 
                                     id="username" 
                                     placeholder="Contoh: Masukkan Username Anda" >

                                 <?php if (isset($_GET['errorusername'])) { ?>
                                     <span class="invalid-feedback"><?php echo htmlspecialchars($_GET['errorusername']); ?></span>
                                <?php 
                                 } 
                             ?>
                            </div>

                            <button type="submit" name="verifikasi" class="btn btn-primary">Verifikasi</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Belum  punya akun? <a href="register.php">Daftar disini</a></p>
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
        $username = $_POST['username'];

        // Perbaikan query SQL
        $query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE username = '$username'") or die(mysqli_error($koneksi));

        $data = $query->fetch_assoc();

        if ($query->num_rows) {
            echo "<script>location.href='ubahpassword.php?username=$username';</script>";

        } else if(empty($_POST['username']) || $_POST['username'] != $data['username']) {
            
            echo header('location: lupapassword.php?errorusername=Username Harus Sesuai');
        }
    }

?>