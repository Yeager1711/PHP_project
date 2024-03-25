<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['DrinksID'])) { 
        $drinkId = $_GET['DrinksID']; 

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