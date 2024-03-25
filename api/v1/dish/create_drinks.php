<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['DrinkName'])) {
        $drinkName = $data['DrinkName'];
        $checkDrinkNameQuery = "SELECT * FROM dish WHERE DrinkName = '$drinkName'";
        $result = $conn->query($checkDrinkNameQuery);
        if ($result->num_rows > 0) {
            $response = array('message' => 'Drink ' .$drinkName. ' already exists', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
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

    if (isset($data['Price']) && !is_numeric($data['Price'])) {
        $response = array('message' => 'Price must be a valid number', 'status' => 'error');
        echo json_encode($response);
        exit;
    }

    if (isset($data['MenuID'])) {
        $menuID = $data['MenuID'];
        $checkMenuID = "SELECT * FROM category WHERE MenuID = '$menuID'";
        $result = $conn->query($checkMenuID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'Menu ID not found', 'status' => 'error');
            echo json_encode($response);
            exit;
        }
    }

    if (isset($data['DrinkName']) && isset($data['Price']) && isset($data['Description']) && isset($data['Image']) && isset($data['MenuID'])) {
        $drinksName = $data['DrinkName'];
        $price = $data['Price'];
        $description = $data['Description'];
        $image = $data['Image'];
        $menuID = $data['MenuID'];

        $sql = "INSERT INTO dish (DrinkName, Price, Description, Image, MenuID) VALUES ('$drinksName', '$price', '$description', '$image', '$menuID')";

        if ($conn->query($sql) === TRUE) {
            $drinksID = $conn->insert_id;
            $response = array('message' => 'Drinks ' . $drinkName. 'created successfully', 'status' => 'success', 'data' => array('DrinksID' => $drinksID, 'DrinksName' => $drinksName, 'Price' => $price, 'Description' => $description, 'Image' => $image, 'MenuID' => $menuID));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create drinks', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
