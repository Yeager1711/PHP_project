<?php
require_once("configdb.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra xem người dùng tồn tại trong cơ sở dữ liệu hay không
    $checkQuery = "SELECT * FROM account WHERE UserName = '$username' AND Password = '$password'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $response = array('status' => 'success', 'message' => 'Đăng nhập thành công');
    } else {
        $response = array('status' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác');
    }

    // Trả về kết quả dưới dạng JSON
    echo json_encode($response);
}
?>
