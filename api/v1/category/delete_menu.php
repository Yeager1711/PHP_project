<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['MenuID'])) {
        $menuID = $data['MenuID'];

        $getMenuNameQuery = "SELECT MenuName FROM category WHERE MenuID = '$menuID'";
        $result = $conn->query($getMenuNameQuery);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $menuName = $row['MenuName'];

            $sql = "DELETE FROM category WHERE MenuID = '$menuID'";
            $result = $conn->query($sql);

            if ($result && $conn->affected_rows > 0) {
                $response = array('message' => 'Menu ' . $menuName . ' deleted successfully', 'status' => 'success');
                echo json_encode($response);
            } else {
                $response = array('message' => 'Failed to delete menu', 'status' => 'error');
                echo json_encode($response);
            }
        } else {
            $response = array('message' => 'Menu ID not found', 'status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
