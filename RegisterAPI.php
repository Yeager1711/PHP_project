<?php
require_once("./Database/configdb.php");
require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

function isUsernameExists($conn, $username)
{
    $queryCheckUsername = "SELECT COUNT(*) AS usernameCount FROM account WHERE UserName = '$username'";
    $resultCheckUsername = mysqli_query($conn, $queryCheckUsername);
    $rowUsernameCount = mysqli_fetch_assoc($resultCheckUsername);
    $usernameCount = $rowUsernameCount['usernameCount'];
    return $usernameCount > 0;
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function sendEmail($email)
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
        $mail->Subject = "Thank You";
        $mail->Body = 'Thank you for using our app';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($username) || empty($password) || empty($email)) {
        $response = array('status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin');
        echo json_encode($response);
        exit();
    }

    if (isUsernameExists($conn, $username)) {
        $response = array('status' => 'error', 'message' => 'Tên người dùng đã tồn tại');
        echo json_encode($response);
        exit();
    }

    $hashedPassword = hashPassword($password);
    $queryGetUserCount = "SELECT COUNT(*) AS userCount FROM account";
    $resultGetUserCount = mysqli_query($conn, $queryGetUserCount);
    $rowUserCount = mysqli_fetch_assoc($resultGetUserCount);
    $userCount = $rowUserCount['userCount'];
    $maRole = ($userCount == 0) ? 1 : 2;

    $query = "INSERT INTO account (UserName, Password, Email, RoleID) 
              VALUES ('$username', '$hashedPassword', '$email', $maRole)";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (sendEmail($email)) {
            $response = array('status' => 'success', 'message' => 'Đăng ký thành công và email đã được gửi');
        } else {
            $response = array('status' => 'success', 'message' => 'Đăng ký thành công, nhưng không thể gửi email');
        }
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Đăng ký không thành công');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Yêu cầu không hợp lệ');
    echo json_encode($response);
}
?>


