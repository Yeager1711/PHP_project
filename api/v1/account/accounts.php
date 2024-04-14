<?php
require_once('./db_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ request
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu
    if (isset($data['FullName']) && isset($data['Email']) && isset($data['UserName']) && isset($data['Password']) && isset($data['RoleID'])) {
        $fullName = $data['FullName'];
        $email = $data['Email'];
        $username = $data['UserName'];
        $password = $data['Password'];
        // $roleID = $data['RoleID'];
        $roleID = 2;
        // Tạo câu truy vấn INSERT
        $sql = "INSERT INTO account (FullName, Email, UserName, Password, RoleID) VALUES ('$fullName', '$email', '$username', '$password', '$roleID')";

        if ($conn->query($sql) === TRUE) {
            // Trả về thông tin account đã được tạo
            $accountID = $conn->insert_id;
            $response = array('message' => 'Account created successfully', 'status' => 'success', 'data' => array('AccountID' => $accountID, 'FullName' => $fullName, 'Email' => $email, 'UserName' => $username, 'Password' => $password, 'RoleID' => $roleID));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create account', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Tạo câu truy vấn SELECT
    $sql = "SELECT * FROM account";
    $result = $conn->query($sql);
    $response = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
    }

    echo json_encode($response);
}

// Xử lý phương thức PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Lấy dữ liệu từ request
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu
    if (isset($data['AccountID']) && isset($data['UserName']) && isset($data['Password']) && isset($data['RoleID'])) {
        $accountID = $data['AccountID'];
        $username = $data['UserName'];
        $password = $data['Password'];
        $roleID = $data['RoleID'];

        // Tạo câu truy vấn UPDATE
        $sql = "UPDATE account SET UserName = '$username', Password = '$password', RoleID = '$roleID' WHERE AccountID = '$accountID'";

        if ($conn->query($sql) === TRUE) {
            // Trả về thông tin account đã được cập nhật
            $response = array('AccountID' => $accountID, 'UserName' => $username, 'Password' => $password, 'RoleID' => $roleID);
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to update account', 'status' => 'error', 'error' => $conn->error);
            echo json_encode($response);
        }
    } else {
        $response = array('message' => 'Missing required information', 'status' => 'error');
        echo json_encode($response);
    }
}

// Xử lý phương thức DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Lấy AccountID từ query string
    $accountID = $_GET['AccountID'];

    // Tạo câu truy vấn DELETE
    $sql = "DELETE FROM account WHERE AccountID ='$accountID'";

    if ($conn->query($sql) === TRUE) {
        $response = array('message' => 'Account deleted successfully', 'status' => 'success');
        echo json_encode($response);
    } else {
        $response = array('message' => 'Failed to delete account', 'status' => 'error', 'error' => $conn->error);
        echo json_encode($response);
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>