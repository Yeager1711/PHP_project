<?php
require_once('../db_connect.php');
// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['DrinksID'])) { // Kiểm tra xem có tham số DrinksID được truyền vào không
        $drinkId = $_GET['DrinksID']; // Nhận giá trị DrinksID từ tham số truyền vào

        // Tạo câu truy vấn SELECT với điều kiện WHERE DrinksID = $drinkId
        $sql = "SELECT * FROM drinks WHERE DrinksID = $drinkId";

        $result = $conn->query($sql);
        $response = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }

        echo json_encode($response);
    } else {
        echo "DrinksID không được cung cấp.";
    }
}

$conn->close();
?>