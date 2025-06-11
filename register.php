<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';


include 'koneksi.php';


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
                 <div class="col-12 col-lg-10 mx-auto">
                    <div class="card radius-15">
                        <div class="card-header text-center">
                            <h3 class="mt-4 font-weight-bold">Silahkan Register</h3>
                        </div>
                        <div class="card-body p-md-5">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" class="form-control <?php if(isset($_GET['error'])){echo'is-invalid';}?>"  name="nik" placeholder="Contoh : 211198" >
                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control <?php if(isset($_GET['error'])){echo'is-invalid';}?>"  name="nama" placeholder="Contoh : Ahmad Budi" >
                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Telepon</label>
                                    <input type="text" class="form-control <?php if(isset($_GET['error'])){echo'is-invalid';}?>"  name="telp" placeholder="Contoh : 08xxxx" >
                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control <?php if(isset($_GET['error'])){echo'is-invalid';}?>"  name="username" placeholder="Contoh : Masukan Username Anda" >
                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control <?php if(isset($_GET['error'])){echo'is-invalid';}?>" name="password" placeholder="Contoh : Masukkan Password Anda" >
                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>
                                </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
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

    if(isset($_POST['submit'])){
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['nik']) ||  empty($_POST['nama']) || empty($_POST['telp']) || empty($_POST['username']) || empty($_POST['password'])){
            header('Location: register.php?error=Data ini wajib diisi!');
             // Menghentikan eksekusi setelah redirect
        } else {

          $query = mysqli_query($koneksi, "INSERT INTO masyarakat(nik, nama, username, password, telp)
                                     VALUES('$nik', '$nama', '$username', '$password', '$telp')") or die(mysqli_error($koneksi));
         if($query) {
            echo "<script>alert('Berhasil melakukan register, silahkan login'); </script>";
            echo "<script>document.location.href='login.php';</script>";
        }else {
            echo "<script>alert('Gagal melakukan register, coba lagi'); </script>";
            echo "<script>document.location.href='register.php'; </script>";
        }

    }
}


?>