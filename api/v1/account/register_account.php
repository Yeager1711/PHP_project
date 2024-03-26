<?php
require_once('../db_connect.php');

session_start(); // Bắt đầu phiên làm việc

function generateAccountID() {
    $uuid = sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );

    return $uuid;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ request
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu
    if (isset($data['FullName']) && isset($data['Email']) && isset($data['UserName']) && isset($data['Password']) && isset($data['RoleID'])) {
        $fullName = $data['FullName'];
        $email = $data['Email'];
        $username = $data['UserName'];
        $password = $data['Password'];
        $roleID = "8895cda3-548d-4cca-808c-6053256da06e"; // Cố định giá trị RoleID là 2

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['fullname'])) {
            $response = array('message' => 'You are already registered and logged in', 'status' => 'error');
            echo json_encode($response);
            exit(); // Dừng thực thi mã
        }

        $accountID = generateAccountID();

        // Tạo câu truy vấn INSERT
        $sql = "INSERT INTO account (AccountID, FullName, Email, UserName, Password, RoleID) VALUES ('$accountID', '$fullName', '$email', '$username', '$password', '$roleID')";

        if ($conn->query($sql) === TRUE) {
            // Trả về thông tin account đã được tạo
            $response = array('message' => 'Account created successfully', 'status' => 'success', 'data' => array('AccountID' => $accountID, 'FullName' => $fullName, 'Email' => $email, 'UserName' => $username, 'Password' => $password, 'RoleID' => $roleID));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create account', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>