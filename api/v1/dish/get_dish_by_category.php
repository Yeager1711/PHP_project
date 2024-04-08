<?php
require_once('../db_connect.php');

// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['CateID'])) { 
        $cateId = $_GET['CateID']; 

        // Sử dụng câu truy vấn PREPARE để tránh lỗi SQL injection
        $stmt = $conn->prepare("SELECT * FROM dish WHERE CateID = ?");
        $stmt->bind_param("s", $cateId);
        $stmt->execute();

        $result = $stmt->get_result();
        $response = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    } else {
        echo "CateID không được cung cấp.";
    }
}

$stmt->close();
$conn->close();
?>