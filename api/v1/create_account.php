<?php
require_once('db_connect.php');

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
// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>