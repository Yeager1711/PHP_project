<?php
require_once('../db_connect.php');
// Xử lý phương thức DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Lấy AccountID từ query string
    $accountID = $_GET['AccountID'];

    // Tạo câu truy vấn DELETE
    $sql = "DELETE FROM account WHERE AccountID ='$accountID'";

    if ($conn->query($sql) === TRUE) {
        $response = array('message' => 'Account deleted successfully', 'status' => 'success');
        echo json_encode($response);
    } else {
        $response = array('message' => 'Failed to delete account', 'status' => 'error', 'error' => $conn->error);
        echo json_encode($response);
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>