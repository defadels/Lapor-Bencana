<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)

include 'koneksi.php';



function sendmail_verify($email, $verify_otp){
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fadhil.sonic@gmail.com';                     //SMTP username
    $mail->Password   = 'rydusqwpzorpnyso';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Admin Pengaduan Masyarakat');
    $mail->addAddress($email, 'User');     //Add a recipient
    $mail->addReplyTo('no-reply@example.com', 'Information');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Email';

    $email_template = "
    <h1>Verifikasi Email</h1>
    <p>Kamu telah melakukan pendaftaran di website Pengaduan Masyarakat</p>
    <br>
    <h2>Kode OTP</h2>
    <h1>$verify_otp</h1>
    <br>
    <p>Klik <a href='http://localhost/pengaduan/verify.php?email=$email'>disini</a> untuk verifikasi email</p>
    ";

    $mail->Body    = $email_template;

    $mail->send();
    echo 'Email berhasil dikirim';


}


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
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Cth: email@mail.com" id="" class="form-control <?php if(isset($_GET['error']) || isset($_GET['email_alert'])){echo'is-invalid';}?>">

                                    <?php
                                        if(isset($_GET['error'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['error']; ?> </p> </span>
                                        
                                    <?php
                                        }
                                    ?>

<?php
                                        if(isset($_GET['email_alert'])){
                                    ?>

                                    <span class="invalid-feedback">
                                        <p> <?php echo $_GET['email_alert']; ?> </p> </span>
                                        
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

        $kode_otp = rand(1000000,100);
        $verify_otp = $kode_otp;
        $status_verify = 'belum';
        $nik = $_POST['nik'];
        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek_email = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE email = '$email' ")or die(mysqli_error($koneksi));
        $verify_email = $cek_email->fetch_assoc();

        if (empty($_POST['nik']) ||  empty($_POST['nama']) || empty($_POST['telp']) || empty($_POST['username']) || empty($_POST['password'] || empty($_POST['email']))){
            header('Location: register.php?error=Data ini wajib diisi!');
             // Menghentikan eksekusi setelah redirect
        } elseif($verify_email['email'] == $email){ 
            header('Location: register.php?email_alert=Email sudah terpakai!');
        }
        
        else {

          $query = mysqli_query($koneksi, "INSERT INTO masyarakat(nik, email, nama, username, password, telp, kode_otp, status_verify)
                                     VALUES('$nik', '$email','$nama', '$username', '$password', '$telp', '$kode_otp', '$status_verify')") or die(mysqli_error($koneksi));
         if($query) {

            sendmail_verify($email, $verify_otp);

            echo "<script>alert('Berhasil melakukan register, silahkan login'); </script>";
            echo "<script>document.location.href='login.php';</script>";
        }else {
            echo "<script>alert('Gagal melakukan register, coba lagi'); </script>";
            echo "<script>document.location.href='register.php'; </script>";
        }

    }
}


?>