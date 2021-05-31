<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/PHPMailer.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/SMTP.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/PHPMailer/src/Exception.php");

$password = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/views/password.txt");


//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'chipperwebdev@gmail.com';                     //SMTP username
    $mail->Password   = $password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('chipperwebdev@gmail.com', 'Chipper');
    $mail->addAddress($user_email, $user_email);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your account has been deactivated';
    $mail->Body    = 'An admin has deactivated your account.';
    $mail->AltBody = 'An admin has deactivated your account.';

    $mail->send();
    echo 'Message has been sent';
    //admin user back to users page
    // header('Location: /users');
    // exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
