<?php
require_once('../db_connect.php');

// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Kiểm tra xem CateID đã được truyền vào hay chưa
    if (isset($_GET['CateID'])) {
        $CateID = $_GET['CateID'];

        // Tạo câu truy vấn SELECT với điều kiện CateID
        $sql = "SELECT * FROM category WHERE CateID = '$CateID'";
        $result = $conn->query($sql);
        $response = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }

        echo json_encode($response);
    } else {
        echo "CateID không được truyền vào.";
    }
}

$conn->close();
?>