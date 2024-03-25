<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['DrinksID'])) {
        $drinksID = $data['DrinksID'];

        $sql = "DELETE FROM drinks WHERE DrinksID = '$drinksID'";

        $result = $conn->query($sql);

        if ($result) {
            if ($conn->affected_rows > 0) {
                $response = array('message' => 'Drinks deleted successfully', 'status' => 'success');
                echo json_encode($response);
            } else {
                $response = array('message' => 'No drinks found with the provided ID', 'status' => 'error');
                echo json_encode($response);
            }
        } else {
            $response = array('message' => 'Failed to delete drinks', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
