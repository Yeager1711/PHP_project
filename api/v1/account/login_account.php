<?php
require_once('../db_connect.php');
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['UserName']) && isset($data['Password'])) {
        $username = $data['UserName'];
        $password = $data['Password'];

        $sql = "SELECT * FROM account WHERE UserName = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
          
            if (password_verify($password, $row['Password'])) {
                $token = generateToken();
                
                // Lưu thông tin người dùng vào session
                $_SESSION['username'] = $row['UserName'];
                $_SESSION['fullname'] = $row['FullName'];
                $_SESSION['accountId'] = $row['AccountID'];
                // Thiết lập thời gian hết hạn cho token (ví dụ: 1 giờ)
                $expiry = time() + 3600; // 1 giờ từ thời điểm hiện tại
                
                // Lưu thông tin token và thời gian hết hạn vào session
                $_SESSION['token'] = $token;
                $_SESSION['expiry'] = $expiry;

                $response = array('message' => 'Login successful', 'status' => 'success', 'data' => $row, 'token' => $token, 'expiry' => $expiry);
                echo json_encode($response);
            } else {
                $response = array('message' => 'Invalid username or password', 'status' => 'error');
                echo json_encode($response);
            }
        } else {
            $response = array('message' => 'Invalid username or password', 'status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();

// Hàm tạo token ngẫu nhiên
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}
?>
