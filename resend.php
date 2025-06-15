<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)

include 'koneksi.php';

$email = $_GET['email'];
$kode_otp = rand(1000000,100);
$verify_otp = $kode_otp;

$update_otp = mysqli_query($koneksi, "UPDATE masyarakat SET kode_otp = '$verify_otp' WHERE email = '$email' ")or die(mysqli_error($koneksi));


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
// echo 'Email berhasil dikirim';

// echo "<script>alert('Kode OTP Sudah Dikirim Ulang');</script>";
echo "<script>document.location.href='verifikasi_akun.php?status=Kode OTP Sudah Dikirim Ulang'</script>";




?>