<?php
require_once('../../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM orders";

    $result = $conn->query($sql);

    if ($result) {
        $orders = array();

        while ($row = $result->fetch_assoc()) {
            $orderID = $row['OrderID'];
            $createdAt = $row['CreatedAt'];
            $accountID = $row['AccountID'];
            $totalAmount = $row['TotalAmount'];

            $order = array(
                'OrderID' => $orderID,
                'CreatedAt' => $createdAt,
                'AccountID' => $accountID,
                'TotalAmount' => $totalAmount,
            );

            $orders[] = $order;
        }

        $response = array('status' => 'success', 'data' => $orders);
        echo json_encode($response);
    } else {
        $response = array('status' => 'success', 'data' => array());
        echo json_encode($response);
    }
} else {
    $response = array('message' => 'Method not allowed', 'status' => 'error');
    echo json_encode($response);
}

$conn->close();
?>