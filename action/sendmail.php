<?php

// Include PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();


// Configure your SMTP settings
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'zajampratik@gmail.com';
$mail->Password = 'pztkepfdtrkdhngk';

// Set email properties
$mail->setFrom('zajampratik@gmail.com', 'Pratik Zajam');
$mail->addAddress($email,$username);
$mail->Subject = 'Otp varification';
$body = 'Hello ' . $username . ',<br><br>';
$body .= 'Your OTP for verification is: ' . $generate_otp. '<br><br>';
$body .= 'Please use this OTP to verify your account.<br><br>';
$body .= 'Thank you,<br>';
$body .= 'Pratik Zajam';
$mail->msgHTML($body);

// Send the email
if ($mail->send()) {
    // echo "Email sent successfully.";
} else {
    // echo "Email could not be sent. Error: " . $mail->ErrorInfo;
}

?>
