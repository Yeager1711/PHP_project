<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT * FROM category";
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