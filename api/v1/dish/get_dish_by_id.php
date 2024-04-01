<?php
require_once('../db_connect.php');

// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['DishID'])) { 
        $dishID = $_GET["DishID"];
        $cateId = $_GET['DishID']; 

        $stmt = $conn->prepare("SELECT * FROM dish WHERE DishID = ?");
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

