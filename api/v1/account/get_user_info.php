<?php
require_once('../db_connect.php');
session_start(); // Bắt đầu phiên làm việc

// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['AccountID'])) {
        $response = array('message' => 'Chưa đăng nhập', 'status' => 'error');
        http_response_code(401); // Không được phép truy cập
        echo json_encode($response);
        exit();
    }

    // Lấy AccountID từ session hoặc từ request (tùy vào cách bạn implement logic đăng nhập)
    $accountID = $_SESSION['AccountID'];

    // Tạo câu truy vấn SELECT để lấy thông tin người dùng
    $sql = "SELECT * FROM account WHERE AccountID = '$accountID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      
        // Trả về thông tin người dùng
        $response = array('message' => 'Lấy thông tin người dùng thành công', 'status' => 'success', 'data' => $row);
        echo json_encode($response);
    } else {
        $response = array('message' => 'Không tìm thấy thông tin người dùng', 'status' => 'error');
        http_response_code(404); 
        echo json_encode($response);
    }
} else {
    $response = array('message' => 'Phương thức không được hỗ trợ', 'status' => 'error');
    http_response_code(405); // Phương thức không được hỗ trợ
    echo json_encode($response);
}

$conn->close();
?>
