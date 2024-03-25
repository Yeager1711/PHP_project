<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['MenuName']) && isset($data['Image'])) {
        $menuname = $data['MenuName'];
        $image = $data['Image'];

        if (preg_match('/[!@#$%^&*(),.?":{}|<>~`\-=_+\/\\\[\]]/', $menuname)) {
            $response = array('message' => 'Menu name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $sql = "INSERT INTO menu (MenuName, Image) VALUES ('$menuname', '$image')";

        if ($conn->query($sql) === TRUE) {
            $accountID = $conn->insert_id;
            $response = array('message' => 'Menu created successfully', 'status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create menu', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}
$conn->close();
?>
