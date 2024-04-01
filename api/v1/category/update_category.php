<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['CateID']) && isset($data['CateName']) && isset($data['Image'])) {
        $cateID = $data['CateID'];
        $cateName = $data['CateName'];
        $image = $data['Image'];

        if (preg_match('/[!@#$%^&*(),.?":{}|<>~`\-=_+\/\\\[\]]/', $cateName)) {
            $response = array('message' => 'Category name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $sql_check_category_exist = "SELECT * FROM category WHERE CateID = '$cateID'";
        $result_check_cate_exist = $conn->query($sql_check_category_exist);
        
        if ($result_check_cate_exist->num_rows == 0) {
            $response = array('message' => 'CateID does not exist', 'status' => 'error');
            echo json_encode($response);
            exit;
        }

        $sql = "UPDATE category SET CateName = '$cateName', Image = '$image' WHERE CateID = '$cateID'";

        if ($conn->query($sql) === TRUE) {
            $response = array('message' => 'Category updated successfully', 'status' => 'success', 'data' => array('CateID' => $cateID, 'CateName' => $cateName, 'Image' => $image));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to update category', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
