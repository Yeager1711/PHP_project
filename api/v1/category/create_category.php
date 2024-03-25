<?php
require_once('../db_connect.php');

function generateCateID() {
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

    if (isset($data['CateName']) && isset($data['Image'])) {
        $menuname = $data['CateName'];
        $image = $data['Image'];

        if (preg_match('/[!@#$%^&*(),.?":{}|<>~`\-=_+\/\\\[\]]/', $menuname)) {
            $response = array('message' => 'Category name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $cateID = generateCateID();

        $sql = "INSERT INTO category (CateID, CateName, Image) VALUES ('$cateID', '$menuname', '$image')";

        if ($conn->query($sql) === TRUE) {
            $response = array('message' => 'Category created successfully', 'status' => 'success', 'data' => array('CateID' => $cateID, 'CateName' => $menuname, 'Image' => $image));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create Category', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>