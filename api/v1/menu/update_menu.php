<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['MenuID']) && isset($data['MenuName']) && isset($data['Image'])) {
        $menuID = $data['MenuID'];
        $menuName = $data['MenuName'];
        $image = $data['Image'];

        if (preg_match('/[!@#$%^&*(),.?":{}|<>~`\-=_+\/\\\[\]]/', $menuName)) {
            $response = array('message' => 'Menu name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $sql_check_menu_exist = "SELECT * FROM menu WHERE MenuID = '$menuID'";
        $result_check_menu_exist = $conn->query($sql_check_menu_exist);
        
        if ($result_check_menu_exist->num_rows == 0) {
            $response = array('message' => 'MenuID does not exist', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $sql = "UPDATE menu SET MenuName = '$menuName', Image = '$image' WHERE MenuID = '$menuID'";

        if ($conn->query($sql) === TRUE) {
            $response = array('message' => 'Menu updated successfully', 'status' => 'success', 'data' => array('MenuID' => $menuID, 'MenuName' => $menuName, 'Image' => $image));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to update menu', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
