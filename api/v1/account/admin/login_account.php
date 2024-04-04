<?php
require_once('../../db_connect.php');
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
            // Đăng nhập thành công
            $row = $result->fetch_assoc();

            // Kiểm tra role ID của người dùng
            if ($row['RoleID'] === 'f4b28d9d-4418-41f2-8bbd-cf054edf64ea') {
                // Lưu thông tin đăng nhập vào session
                $_SESSION['username'] = $row['UserName'];
                $_SESSION['fullname'] = $row['FullName'];

                $response = array('message' => 'Login successful', 'status' => 'success', 'data' => $row);
                echo json_encode($response);
            } else {
                // Người dùng không có quyền truy cập
                $response = array('message' => 'You do not have permission to access', 'status' => 'error');
                echo json_encode($response);
            }
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
?>