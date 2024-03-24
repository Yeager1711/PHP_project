<?php
require_once('../db_connect.php');
// Xử lý phương thức GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ request
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu
    if (isset($data['MenuName']) && isset($data['Image'])) {
        $menuname = $data['MenuName'];
        $image = $data['Image'];
        // $roleID = $data['RoleID'];
        $roleID = 2;
        // Tạo câu truy vấn INSERT
        $sql = "INSERT INTO account (MenuName, Image) VALUES ('$menuname', '$image')";

        if ($conn->query($sql) === TRUE) {
            // Trả về thông tin account đã được tạo
            $accountID = $conn->insert_id;
            $response = array('message' => 'Menu created successfully', 'status' => 'success', 'data' => array('AccountID' => $accountID, 'FullName' => $fullName, 'Email' => $email, 'UserName' => $username, 'Password' => $password, 'RoleID' => $roleID));
            echo json_encode($response);
        } else {
            $response = array('message' => 'Failed to create menu', 'status' => 'error', 'error' => $conn->error);
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