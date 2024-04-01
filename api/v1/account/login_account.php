<?php
require_once('../db_connect.php');
session_start(); // Bắt đầu phiên làm việc

// Xử lý phương thức POST (đăng nhập)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ request
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu
    if (isset($data['UserName']) && isset($data['Password'])) {
        // Lấy thông tin tên người dùng và mật khẩu
        $username = $data['UserName'];
        $password = $data['Password'];

        // Tạo câu truy vấn SELECT để kiểm tra đăng nhập
        $sql = "SELECT * FROM account WHERE UserName = '$username' AND Password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
          
            // Tạo token mới cho người dùng
            $token = generateToken();
            
            // Lưu thông tin người dùng vào session
            $_SESSION['username'] = $row['UserName'];
            $_SESSION['fullname'] = $row['FullName'];

            // Thiết lập thời gian hết hạn cho token (ví dụ: 1 giờ)
            $expiry = time() + 3600; // 1 giờ từ thời điểm hiện tại
            
            // Lưu thông tin token và thời gian hết hạn vào session
            $_SESSION['token'] = $token;
            $_SESSION['expiry'] = $expiry;

            $response = array('message' => 'Login successful', 'status' => 'success', 'data' => $row, 'token' => $token, 'expiry' => $expiry);
            echo json_encode($response);
        } else {
            // Đăng nhập thất bại
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
