<?php
require_once('db_connect.php');

// Xử lý phương thức POST (đăng ký tài khoản)
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
            $response = array('message' => 'Login successful', 'status' => 'success', 'data' => $row);
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

// ...
// Các phương thức GET, PUT và DELETE hiện tại của bạn ở đây
// ...

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>