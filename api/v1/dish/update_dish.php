<?php
require_once('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

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

        $checkDrinksID = "SELECT * FROM dish WHERE DrinksID = '$drinksID'";
        $result = $conn->query($checkDrinksID);
        if ($result->num_rows == 0) {
            $response = array('message' => 'Drinks ID not found', 'status' => 'error');
            echo json_encode($response);
        } else {
            $checkMenuID = "SELECT * FROM menu WHERE MenuID = '$menuID'";
            $result = $conn->query($checkMenuID);
            if ($result->num_rows == 0) {
                $response = array('message' => 'Menu ID not found', 'status' => 'error');
                echo json_encode($response);
            } else {
                if (!is_numeric($price)) {
                    $response = array('message' => 'Price must be a valid number', 'status' => 'error');
                    echo json_encode($response);
                } else {
                    $sql = "UPDATE drinks SET DrinkName = '$drinksName', Price = '$price', Description = '$description', Image = '$image', MenuID = '$menuID' WHERE DrinksID = '$drinksID'";
                    if ($conn->query($sql) === TRUE) {
                        $response = array('message' => 'Drinks updated successfully', 'status' => 'success', 'data' => array('DrinksID' => $drinksID, 'DrinksName' => $drinksName, 'Price' => $price, 'Description' => $description, 'Image' => $image, 'MenuID' => $menuID));
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
