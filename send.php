<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
 
try {
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
    $mail->addAddress('fadhil.adhaa26@gmail.com', 'User');     //Add a recipient
    $mail->addReplyTo('no-reply@example.com', 'Information');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Email';

    $email_template = "
    <h1>Verifikasi Email</h1>
    <h4>Kamu telah melakukan pendaftaran di website Pengaduan Masyarakat</h4>
    <p>Klik <a href='http://localhost/pengaduan/verify.php?email=$email'>disini</a> untuk verifikasi email</p>
    ";

    $mail->Body    = $email_template;

    $mail->send();
    echo 'Email berhasil dikirim';
} catch (Exception $e) {
    echo "Email gagal dikirim. Mailer Error: {$mail->ErrorInfo}";
}