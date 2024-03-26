<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $dishID = $_GET['DishID'];

    // Sử dụng Prepared Statements để chống SQL injection
    $stmt = $conn->prepare("DELETE FROM dish WHERE DishID = ?");
    $stmt->bind_param("s", $dishID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array('message' => 'Dish deleted successfully', 'status' => 'success');
        echo json_encode($response);
    } else {
        $response = array('message' => 'No dish found with the provided ID', 'status' => 'error');
        echo json_encode($response);
    }

    $stmt->close();
} else {
    $response = array('message' => 'Invalid request method', 'status' => 'error');
    echo json_encode($response);
}

$conn->close();
?>