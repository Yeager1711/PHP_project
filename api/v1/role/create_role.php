<?php
require_once('../db_connect.php');

function generateRoleID() {
    $uuid = sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );

    return $uuid;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['Name'])){
        $rolename = $data['Name'];
       

        if (preg_match('/[!@#$%^&*(),.?":{}|<>~`\-=_+\/\\\[\]]/', $rolename)) {
            $response = array('message' => 'Role name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $roleID = generateRoleID();

        $sql = "INSERT INTO role (RoleID, Name) VALUES ('$roleID', '$rolename')";

        if ($conn->query($sql) === TRUE) {
            $response = array('message' => 'Role created successfully', 'status' => 'success', 'data' => array('RoleID' => $roleID, 'Name' => $rolename));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create Role', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>