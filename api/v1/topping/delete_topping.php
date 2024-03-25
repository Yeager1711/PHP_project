<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['ToppingID'])) {
        $toppingID = $data['ToppingID'];

        $getToppingNameQuery = "SELECT Name FROM topping WHERE ToppingID = '$toppingID'";
        $result = $conn->query($getToppingNameQuery);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $toppingName = $row['Name'];

            $sql = "DELETE FROM topping WHERE ToppingID = '$toppingID'";
            $result = $conn->query($sql);

            if ($result && $conn->affected_rows > 0) {
                $response = array('message' => 'Topping ' . $toppingName . ' deleted successfully', 'status' => 'success');
                echo json_encode($response);
            } else {
                $response = array('message' => 'Failed to delete topping', 'status' => 'error');
                echo json_encode($response);
            }
        } else {
            $response = array('message' => 'Topping ID not found', 'status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
