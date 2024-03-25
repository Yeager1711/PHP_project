<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['DrinksID'])) {
        $drinksID = $data['DrinksID'];

        $getDishNameQuery = "SELECT DrinkName FROM dish WHERE DrinksID = '$drinksID'";
        $result = $conn->query($getDishNameQuery);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dishName = $row['DrinkName'];

            $sql = "DELETE FROM dish WHERE DrinksID = '$drinksID'";
            $result = $conn->query($sql);

            if ($result && $conn->affected_rows > 0) {
                $response = array('message' => 'Drink ' . $dishName . ' deleted successfully', 'status' => 'success');
                echo json_encode($response);
            } else {
                $response = array('message' => 'Failed to delete menu', 'status' => 'error');
                echo json_encode($response);
            }
        } else {
            $response = array('message' => 'Drink ID not found', 'status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
