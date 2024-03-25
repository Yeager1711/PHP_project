<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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

    if (isset($data['ToppingID']) && isset($data['Name']) && isset($data['Description']) && isset($data['Price'])) {
        $toppingID = $data['ToppingID'];
        $name = $data['Name'];
        $description = $data['Description'];
        $price = $data['Price'];

        $checkToppingID = "SELECT * FROM topping WHERE ToppingID = '$toppingID'";
        $result = $conn->query($checkToppingID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'Topping ID not found', 'status' => 'error');
            echo json_encode($response);
        } else {
                if (!is_numeric($price)) {
                    $response = array('message' => 'Price must be a valid number', 'status' => 'error');
                    echo json_encode($response);
                } else {
                    $sql = "UPDATE topping SET Name = '$name', Price = '$price', Description = '$description' WHERE ToppingID = '$toppingID'";
                    if ($conn->query($sql) === TRUE) {
                        $response = array('message' => 'Topping updated successfully', 'status' => 'success', 'data' => array('ToppingID' => $toppingID, 'Name' => $name, 'Price' => $price, 'Description' => $description));
                        echo json_encode($response);
                    } else {
                        $response = array('message' => 'Failed to update drinks', 'status' => 'error', 'error' => $conn->error);
                        echo json_encode($response);
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
