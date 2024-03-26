<?php
require_once('../db_connect.php');

function generateToppingID() {
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

    if (isset($data['Name']) && isset($data['Price']) && isset($data['Description'])) {
        $name = $data['Name'];
        $price = $data['Price'];
        $description = $data['Description'];
        $toppingID = generateToppingID();

        $check_query = "SELECT * FROM topping WHERE Name='$name'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            $response = array('message' => 'Topping '. $name .' already exists', 'status' => 'error');
            echo json_encode($response);
        } else {
            $sql = "INSERT INTO topping (ToppingID, Name, Description, Price) VALUES ('$toppingID', '$name', '$description', '$price')";
            if ($conn->query($sql) === TRUE) {
                $drinksID = $conn->insert_id;
                $response = array('message' => 'Topping '. $name .' created successfully', 'status' => 'success', 'data' => array('ToppingID' => $toppingID, 'Name' => $name, 'Description' => $description, 'Price' => $price));
                echo json_encode($response);
            } else {
                $response = array('message' => 'Failed to create topping', 'status' => 'error', 'error' => $conn->error);
                echo json_encode($response);
            }
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>