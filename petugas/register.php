<?php

include '../koneksi.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Register Petugas</title>
	<!--favicon-->
	<link rel="icon" href="../foto/KabTegal.png" type="image/png" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="../assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="../assets/css/app.css" />
</head>

<body class="bg-login">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="../assets/images/Dinsos.png" width="120" alt="">
										<h3 class="mt-4 font-weight-bold">Silahkan Daftar Akun</h3>
									</div>
									
                                <form method="POST">
									<div class="form-group mt-4">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_petugas"  class="form-control" placeholder="Masukan Nama Lengkap Anda" />
									</div>
                                    <div class="form-group mt-4">
										<label>Nomor Telepon</label>
										<input type="text" name="telp"  class="form-control" placeholder="Masukan Nomor Telepon Anda" />
									</div>
                                    <div class="form-group mt-4">
										<label>Username</label>
										<input type="text" name="username"  class="form-control" placeholder="Masukan Username Anda" />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" />
									</div>
									
									<div class="btn-group mt-3 w-100">
										<button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
										<button type="button" class="btn btn-primary"><i class="lni lni-arrow-right"></i>
										</button>
									</div>
									<hr>
								</form>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="../assets/images/login-images/register-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>
</html>

<?php

    if(isset($_POST['register'])){
        $nama_petugas = $_POST['nama_petugas'];
        $telp = $_POST['telp'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = 'petugas';


        $query_register = mysqli_query($koneksi, "INSERT INTO petugas(nama_petugas, username, password, telp, level)
                            VALUES('$nama_petugas','$username','$password','$telp','$level')") or die(mysqli_error($koneksi));

        if($query_register){
            echo "<script>alert('Berhasil Daftar Akun, Silahkan Login'); </script>";
            echo "<script> document.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Gagal Daftar Akun, Silahkan Coba Lagi'); </script>";
            echo "<script> document.location.href='register.php';</script>";
        }
    }

?>


