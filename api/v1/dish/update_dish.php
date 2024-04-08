<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['DishName'])) {
        $drinkName = $data['DishName'];
        $specialChars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "/");
        $invalidCharsFound = false;
        foreach ($specialChars as $char) {
            if (strpos($drinkName, $char) !== false) {
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

    if (isset($data['Description'])) {
        $description = $data['Description'];
        $specialChars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "/");
        $invalidCharsFound = false;
        foreach ($specialChars as $char) {
            if (strpos($description, $char) !== false) {
                $invalidCharsFound = true;
                break;
            }
        }
        if ($invalidCharsFound) {
            $response = array('message' => 'Description should not contain special characters', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
    }

    if (isset($data['DishID']) && isset($data['DishName']) && isset($data['Price']) && isset($data['Description']) && isset($data['Amount']) && isset($data['Image']) && isset($data['Status']) && isset($data['CateID']) && isset($data['ToppingID'])) {
        $dishID = $data['DishID'];
        $dishName = $data['DishName'];
        $price = $data['Price'];
        $description = $data['Description'];
        $amount = $data['Amount'];
        $image = $data['Image'];
        $status = $data['Status'];
        $cateID = $data['CateID'];
        $toppingID = $data['ToppingID'];

        $checkDrinksID = "SELECT * FROM dish WHERE DishID = '$dishID'";
        $result = $conn->query($checkDrinksID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'Dish ID not found', 'status' => 'error');
            echo json_encode($response);
        } else {
            $checkMenuID = "SELECT * FROM category WHERE CateID = '$cateID'";
            $result = $conn->query($checkMenuID);
            if ($result->num_rows == 0) {
                $response = array('message' => 'Category ID not found', 'status' => 'error');
                echo json_encode($response);
            } else {
                if (!is_numeric($price)) {
                    $response = array('message' => 'Price must be a valid number', 'status' => 'error');
                    echo json_encode($response);
                } else {
                    $sql = "UPDATE dish SET DishName = '$dishName', Price = '$price', Description = '$description', Amount = '$amount', Image = '$image', Status = '$status', CateID = '$cateID', ToppingID = '$toppingID' WHERE DishID = '$dishID'";
                    if ($conn->query($sql) === TRUE) {
                        $response = array('message' => 'Dish ' . $dishName . ' updated successfully', 'status' => 'success', 'data' => array('DishID' => $dishID, 'DishName' => $dishName, 'Price' => $price, 'Description' => $description, 'Amount' => $amount, 'Image' => $image, 'Status' => $status, 'CateID' => $cateID, 'ToppingID' => $toppingID));
                        echo json_encode($response);
                    } else {
                        $response = array('message' => 'Failed to update dish', 'status' => 'error', 'error' => $conn->error);
                        echo json_encode($response);
                    }
                }
            }
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
