<?php
require_once('../db_connect.php');

function generateDrinksID() {
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

    if (isset($data['DishName'])) {
        $dishName = $data['DishName'];
        $specialChars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "/");
        $invalidCharsFound = false;
        foreach ($specialChars as $char) {
            if (strpos($dishName, $char) !== false) {
                $invalidCharsFound = true;
                break;
            }
        }
        if ($invalidCharsFound) {
            $response = array('message' => 'Dish name should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
    }

  

    if (isset($data['Price']) && !is_numeric($data['Price'])) {
        $response = array('message' => 'Price must be a valid number', 'status' => 'error');
        echo json_encode($response);
        exit;
    }

    if (isset($data['CateID'])) {
        $cateID = $data['CateID'];
        $checkCateID = "SELECT * FROM category WHERE CateID = '$cateID'";
        $result = $conn->query($checkCateID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'CategoryID not found', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
    }
    if (isset($data['ToppingID'])) {
        $toppingID = $data['ToppingID'];
        $checkToppingID = "SELECT * FROM topping WHERE ToppingID = '$toppingID'";
        $result = $conn->query($checkToppingID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'ToppingID not found', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
    }

    if (isset($data['DishName']) && isset($data['Price']) && isset($data['Description']) && isset($data['Amount']) && isset($data['Image']) && isset($data['Status']) && isset($data['CateID']) && isset($data['ToppingID'])) {
        $dishName = $data['DishName'];
        $price = $data['Price'];
        $description = $data['Description'];
        $amount = $data['Amount'];
        $image = $data['Image'];
        $status = $data['Status'];
        $cateID = $data['CateID'];
        $toppingID = $data['ToppingID'];
        $dishID = generateDrinksID();

        $sql = "INSERT INTO dish (DishID, DishName, Price, Description, Amount, Image, Status, CateID, ToppingID) VALUES ('$dishID', '$dishName', '$price', '$description', '$amount', '$image','$status', '$cateID', '$toppingID')";

        if ($conn->query($sql) === TRUE) {
            $response = array('message' => 'Drinks dish created successfully', 'status' => 'success', 'data' => array('DishID' => $dishID, 'DishName' => $dishName, 'Price' => $price, 'Description' => $description, 'Amount' => $amount, 'Image' => $image, 'Status' => $status, 'CateID' => $cateID, 'ToppingID' => $toppingID,));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create drinks dish', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>