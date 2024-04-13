<?php
require_once('../db_connect.php');

function generateOrderID() {
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

    if (isset($data['CreatedAt']) && isset($data['AccountID']) && isset($data['TotalAmount']) && isset($data['OrderDetails']) && is_array($data['OrderDetails'])) {
        $createdAt = $data['CreatedAt'];
        $accountID = $data['AccountID'];
        $totalAmount = $data['TotalAmount'];
        $orderDetails = $data['OrderDetails'];

        // Bắt đầu một transaction
        $conn->begin_transaction();

        try {
            // Tạo thông tin đơn hàng (orders)
            $orderID = generateOrderID();
            $sqlOrders = "INSERT INTO orders (OrderID, CreatedAt, AccountID, TotalAmount) VALUES ('$orderID', '$createdAt', '$accountID', '$totalAmount')";
            $conn->query($sqlOrders);

            // Tạo thông tin chi tiết đơn hàng (orderdetail)
            foreach ($orderDetails as $orderDetail) {
                $dishID = $orderDetail['DishID'];
                $size = $orderDetail['Size'];
                $quantity = $orderDetail['Quantity'];
                $price = $orderDetail['Price'];
                $total = $orderDetail['Total'];
                $topping = $orderDetail['Topping'];
                $tableName = $orderDetail['TableName'];

                $sqlOrderDetail = "INSERT INTO orderdetail (OrderID, DishID, Size, Quantity, Price, Total, Topping, TableName) VALUES ('$orderID', '$dishID', '$size', '$quantity', '$price', '$total', '$topping', '$tableName')";
                $conn->query($sqlOrderDetail);
            }

            // Hoàn thành transaction và lưu các thay đổi vào cơ sở dữ liệu
            $conn->commit();

            $response = array('message' => 'Order created successfully', 'status' => 'success', 'data' => array('OrderID' => $orderID, 'CreatedAt' => $createdAt, 'AccountID' => $accountID, 'TotalAmount' => $totalAmount, 'OrderDetails' => $orderDetails));
            echo json_encode($response);
        } catch (Exception $e) {
            // Nếu có lỗi xảy ra, rollback transaction để không lưu các thay đổi vào cơ sở dữ liệu
            $conn->rollback();

            $response = array('message' => 'Failed to create Order', 'status' => 'error', 'error' => $e->getMessage());
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

$conn->close();
?>