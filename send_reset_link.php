<?php
require_once("./Database/configdb.php");
require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email, $resetToken)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'voankhanh0@gmail.com';
        $mail->Password = 'wuub augj xzei eqtm';

        $mail->setFrom('voankhanh0@gmail.com', 'KhanhAn');
        $mail->addAddress($email);
        $mail->addReplyTo('voankhanh0@gmail.com', 'KhanhAn');

        $mail->IsHTML(true);
        $mail->Subject = "Reset Your Password";
        $mail->Body = 'Click this link to reset your password: http://localhost/PROJECT/DoAnThu2/reset_password.php?token=' . $resetToken;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        echo "Please provide your email.";
        exit();
    }

    $queryCheckEmail = "SELECT * FROM account WHERE Email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);

    if (mysqli_num_rows($resultCheckEmail) > 0) {
        $resetToken = bin2hex(random_bytes(16));
        $queryUpdateToken = "UPDATE account SET ResetToken = '$resetToken' WHERE Email = '$email'";
        mysqli_query($conn, $queryUpdateToken);

        if (sendEmail($email, $resetToken)) {
            echo "Reset link has been sent to your email.";
        } else {
            echo "Failed to send reset link.";
        }
    } else {
        echo "Email not found.";
    }
} else {
    echo "Invalid request.";
}
?>
