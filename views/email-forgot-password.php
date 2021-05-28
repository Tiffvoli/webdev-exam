<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
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
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'chipperwebdev@gmail.com';                     //SMTP username
    $mail->Password   = $password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('chipperwebdev@gmail.com', 'Chipper');
    $mail->addAddress('chipperwebdev@gmail.com', 'The user');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot Password';
    $mail->Body    = 'Please click the link below to create a new password. <br> <a href="http://localhost:8080/reset-password">Reset Password</a>';
    $mail->AltBody = 'Forgot password';

    $mail->send();
    // echo 'Message has been sent';

    // //send user to home
    // header('Location: /forgot-password');
    // exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php');
?>
<section id="deactivate-page" class="center-text">
    <h1 class="title">Forgot Password?</h1>
    <br />
    <p>An email has been sent to your email with a link to reset your password.</p>
    <a href="/" class="btn">Return home</a>
</section>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php'); ?>