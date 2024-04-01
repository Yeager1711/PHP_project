<?php
require_once('../db_connect.php');
// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Tạo câu truy vấn SELECT
    $sql = "SELECT * FROM topping";
    $result = $conn->query($sql);
    $response = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
    }
    echo json_encode($response);
}

$conn->close();
?>