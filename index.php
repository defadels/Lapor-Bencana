<?php

    include 'koneksi.php';

    session_start();

    if(!isset($_SESSION['masyarakat'])) {
        echo"<script>alert('Tidak bisa masuk,harus login'); </script>";
        echo"<script>document.location.href='login.php'; </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebencanaan</title>

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
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 text-white bg-dark border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $_SESSION['masyarakat']['nama']; ?></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a href="index.php" class="p-2 text-white">Laporan</a>
            <a href="?halaman=narahubung" class="p-2 text-white">Narahubung</a>
        </nav>
        <a onclick="return confirm('Apakah anda  ingin keluar?');" href="logout.php" class="btn btn-outline-info">Logout</a>
    </div>

    <div class="wrapper">
        <div class="container align-item-center justify-content-center mt-5">
            <div class="row">
                
            <?php

                if(isset($_GET['halaman'])){
                    if($_GET['halaman'] == 'narahubung'){
                        include 'narahubung.php';
                    } else if($_GET['halaman']== 'tambahpengaduan'){
                        include 'tambahpengaduan.php';
                    } else if($_GET['halaman'] == 'editpengaduan') {
                        include 'editpengaduan.php';
                    } else if($_GET['halaman'] == 'hapuspengaduan') {
                        include 'hapuspengaduan.php';
                    } else if($_GET['halaman'] == 'detailpengaduan') {
                        include 'detailpengaduan.php';
                    }
                }else{
                    include 'home.php';
                }

            ?>
                 </div>
            </div>
        </div>
    </div>

<!-- jQuery, Papper -->
<script src="assets/js/jquery.min.js"></script>
</body>
</html>