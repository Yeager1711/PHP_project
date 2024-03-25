<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['DrinkName'])) {
        $drinkName = $data['DrinkName'];
        $specialChars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "/");
        $invalidCharsFound = false;
        foreach ($specialChars as $char) {
            if (strpos($drinkName, $char) !== false) {
                $invalidCharsFound = true;
                break;
            }
        }
        if ($invalidCharsFound) {
            $response = array('message' => 'Drink name should not contain special characters', 'status' => 'error');
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

    if (isset($data['DrinksID']) && isset($data['DrinkName']) && isset($data['Price']) && isset($data['Description']) && isset($data['Image']) && isset($data['MenuID'])) {
        $drinksID = $data['DrinksID'];
        $drinksName = $data['DrinkName'];
        $price = $data['Price'];
        $description = $data['Description'];
        $image = $data['Image'];
        $menuID = $data['MenuID'];

        $checkDrinksID = "SELECT * FROM dish WHERE DrinksID = '$drinksID'";
        $result = $conn->query($checkDrinksID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'Drinks ID not found', 'status' => 'error');
            echo json_encode($response);
        } else {
            $checkMenuID = "SELECT * FROM category WHERE MenuID = '$menuID'";
            $result = $conn->query($checkMenuID);
            if ($result->num_rows == 0) {
                $response = array('message' => 'Menu ID not found', 'status' => 'error');
                echo json_encode($response);
            } else {
                if (!is_numeric($price)) {
                    $response = array('message' => 'Price must be a valid number', 'status' => 'error');
                    echo json_encode($response);
                } else {
                    $sql = "UPDATE dish SET DrinkName = '$drinksName', Price = '$price', Description = '$description', Image = '$image', MenuID = '$menuID' WHERE DrinksID = '$drinksID'";
                    if ($conn->query($sql) === TRUE) {
                        $response = array('message' => 'Drinks'. $drinksName . 'updated successfully', 'status' => 'success', 'data' => array('DrinksID' => $drinksID, 'DrinksName' => $drinksName, 'Price' => $price, 'Description' => $description, 'Image' => $image, 'MenuID' => $menuID));
                        echo json_encode($response);
                    } else {
                        $response = array('message' => 'Failed to update drinks', 'status' => 'error', 'error' => $conn->error);
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
