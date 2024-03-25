<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['Name'])) {
        $name = $data['Name'];
        $specialChars = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "/");
        $invalidCharsFound = false;
        foreach ($specialChars as $char) {
            if (strpos($name, $char) !== false) {
                $invalidCharsFound = true;
                break;
            }
        }
        if ($invalidCharsFound) {
            $response = array('message' => 'Topping name should not contain special characters', 'status' => 'error');
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

    if (isset($data['Name']) && isset($data['Price']) && isset($data['Description']) && isset($data['ToppingID'])) {
        $name = $data['Name'];
        $price = $data['Price'];
        $description = $data['Description'];
        $toppingID = $data['ToppingID'];

        $sql = "INSERT INTO topping (ToppingID, Name, Description, Price) VALUES ('$toppingID', '$name', '$description', '$price')";

        if ($conn->query($sql) === TRUE) {
            $drinksID = $conn->insert_id;
            $response = array('message' => 'Topping created successfully', 'status' => 'success', 'data' => array('ToppingID' => $toppingID, 'Name' => $name, 'Description' => $description, 'Price' => $price));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create topping', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>
