<?php
ob_start();
require("../../config/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Components/PHPMailer/src/Exception.php';
require '../Components/PHPMailer/src/PHPMailer.php';
require '../Components/PHPMailer/src/SMTP.php';

$baseurl=BASE_URL;
$id=$_GET['id'];
$email=$_GET['email'];
echo 'Click on the link and verify your email<br>
    <a href="'.$baseurl.'verifyemail.php?id='.$id.'">Click to verify</a>';

$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'beggarscorpoffice@gmail.com';                     //SMTP username
    $mail->Password   = 'utyawzloqcwljeug';                               //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //default => ENCRYPTION_SMTPS 465- for reference Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('beggarscorpoffice@gmail.com', 'Beggars Corporation');
    $mail->addAddress($email, 'Email Verification');     //Add a recipient

    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('https://www.beggarscorporation.com/');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification';
    $mail->Body    = 'Click on the link and verify your email<br>
    https://shop.beggarscorporation.com/verifyemail.php?id='.$id;

    $mail->send();
    $msg="Verification link send to your email <strong>$email</strong>";
    $url=$baseurl."signup.php?verify=".$msg;
    echo "<script>window.location.href='$url'</script>";
    // header("Location: $url");
    echo 'Message has been sent';
    ob_end_flush();
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>