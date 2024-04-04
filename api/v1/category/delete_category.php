<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['CateID'])) {
        $cateid = $data['CateID'];

        $sql = "DELETE FROM category WHERE CateID = '$cateid'";

        $result = $conn->query($sql);

        if ($result && $conn->affected_rows > 0) {
            $response = array('message' => 'Category deleted successfully', 'status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('message' => 'Category not found', 'status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
