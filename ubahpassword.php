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
                              <label for="username">Masukan Password Baru</label>
                                 <input 
                                     type="password" 
                                     class="form-control <?php if (isset($_GET['errorkonfirmasipassword'])) { echo 'is-invalid'; } ?>" 
                                     name="password_baru" 
                                     id="username" 
                                     placeholder="Masukan Password Baru Anda" >

                                 <?php if (isset($_GET['errorkonfirmasipassword'])) { ?>
                                     <span class="invalid-feedback"><?php echo $_GET['errorkonfirmasipassword']; ?></span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                              <label for="username">Konfirmasi Password</label>
                                 <input 
                                     type="password" 
                                     class="form-control <?php if (isset($_GET['errorkonfirmasipassword'])) { echo 'is-invalid'; } ?>" 
                                     name="konfirmasi_password" 
                                     id="username" 
                                     placeholder="Masukan Konfirmasi Password Baru Anda" >

                                 <?php if (isset($_GET['errorkonfirmasipassword'])) { ?>
                                     <span class="invalid-feedback"><?php echo $_GET['errorkonfirmasipassword']; ?></span>
                                <?php } ?>
                            </div>

                            <button type="submit" name="ubah" class="btn btn-primary">Ubah Password</button>
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

    if (isset($_POST['ubah'])) {
        $password_baru = $_POST['password_baru'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        $username = $_GET['username'];

        if (($_POST['password_baru']) && ($_POST['konfirmasi_password']) != '' ) {

            if($_POST['password_baru'] != $_POST['konfirmasi_password']) {

                echo "<script>location.href='ubahpassword.php?username=".$username."&errorkonfirmasipassword=Password Harus Sesuai';</script>";

            } else {

                $query = mysqli_query($koneksi, "UPDATE masyarakat SET password ='$konfirmasi_password' WHERE username = '$username'") or die(mysqli_error($koneksi));

                echo "<script> alert('Password Anda Berhasil Diubah'); </script>";
                echo "<script> location.href='login.php';</script>";

            }
    

        } else if($_POST['password_baru'] != $_POST['konfirmasi_password'] ) {

            echo "<script>location.href='ubahpassword.php?username=".$username."&errorkonfirmasipassword=Password Harus Sesuai';</script>";

        } else if(empty($_POST['password_baru']) || empty($_POST['konfirmasi_password'])) {

            echo "<script>location.href='ubahpassword.php?username=".$username."&errorkonfirmasipassword=Kolom Ini Wajib Diisi';</script>";

        }
    }
?>

