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

    <style>
        .image-container {
            position: relative;
            text-align: center;
        }
        .image-container img {
            width: 100%;
            height: auto;
        }
        .logo-text {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-80%);
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.7);
            padding: 10px;
            border-radius: 8px;
            white-space: nowrap;
        }
        .logo-text img {
            width: 80px;
            margin-right: 10px;
        }
        .image-container {
             padding-top: 80px; /* Geser ke bawah */
             padding-bottom: 20px; /* Geser ke atas */
        }

    </style>
    
</head>
<body>
    
    <div class="wrapper">
        <div class="container align-item-center justify-content-center mt-5">
            <div class="row">
                 <div class="col-12 col-lg-10 mx-auto">
                    <div class="card radius-15">
                        <div class="row no-gutters">
                            <div class="col-md-5 image-container">
                                <div class=" logo-text">
                                    <img src="foto/KabTegal.png" alt="Logo KabTegal">
                                    <h3 class="m-0 ">Dinas Sosial</h3>
                                </div>
                                <img src="foto/angin.png" class="img-fluid rounded-left" alt="Gambar Utama">
                            </div>
                            <div class="col-md-7">
                                <div class="text-center">
                                    <h3 class="mt-4 font-weight-bold">Silahkan Register</h3>
                                </div>
                                <div class="card-body p-md-5">

                             <form method="POST">
                            <div class="form-group">
                              <label for="username">Username</label>
                                 <input 
                                     type="text" 
                                     class="form-control <?php if (isset($_GET['errorusername'])) { echo 'is-invalid'; } ?>" 
                                     name="username" 
                                     id="username" 
                                     placeholder="Contoh: Masukkan Username Anda" >

                                 <?php if (isset($_GET['errorusername'])) { ?>
                                     <span class="invalid-feedback"><?php echo htmlspecialchars($_GET['errorusername']); ?></span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                              <label for="password">Password</label>
                                 <input 
                                    type="password" 
                                    class="form-control <?php if (isset($_GET['errorpassword'])) { echo 'is-invalid'; } ?>" 
                                    name="password" 
                                    id="password" 
                                    placeholder="Contoh: Masukkan Password Anda">
                                <?php if (isset($_GET['errorpassword'])) { ?>
                                    <span class="invalid-feedback"><?php echo htmlspecialchars($_GET['errorpassword']); ?></span>
                                <?php  
                                 } 

                                 ?>
                            </div>

                            <p><a href="lupapassword.php">Lupa Password?</a></p>

                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="">
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

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($_POST['password']) && empty($_POST['username'])){
           
            echo header('location: login.php?errorusername=Username harus diis&errorpassword=Password harus diisi');

        } else if(empty($_POST['password'])){

            echo header('location: login.php?errorpassword=Password harus diisi');

        } else if (empty($_POST['username'])){

            echo header('location: login.php?errorusername=Username harus diisi');
        }
            else {

            $query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'") or die(mysqli_error($koneksi));

            $cek = $query->num_rows;
    
            if($cek == 1) {
                $_SESSION['masyarakat'] = $query->fetch_assoc();
    
                echo "<script>alert('Berhasil login'); </script>";
                echo "<script> document.location.href='index.php';</script>";
            } else {
            
                echo "<script>alert('Gagal login, Coba lagi'); </script>";
                echo "<script> document.location.href='login.php';</script>";
    
            }  
         }    
      }
?>