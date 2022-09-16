<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

//********************** */ Validating the data and sanitising it ******************************
function TestInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
$to = TestInput($row['email']);
$name = TestInput($row['shop_name']);

$mail = new PHPMailer(true);

//email confirmation
try {
    //Server settings
    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'projectmahala@gmail.com';
    $mail->Password   = 'jatpxeomxxghwssf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('projectmahala@gmail.com');
    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->Subject = "YOUR BUSINESS WAS APPROVED.";

    $mail->Body = "
	<div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
    <h2>Dream Mall</h2>
    <p>{$name} has been approved <a href='https://dreammallmw.com'>dreammallmw.com</a></p>	
    </div>
	";

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('Error! connect to network!')</script>";
}
