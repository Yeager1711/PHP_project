<?php
// require_once("./Database/configdb.php");
// header('Content-Type: application/json');

// function isUsernameAndPasswordValid($conn, $username, $password)
// {
//     $query = "SELECT UserName, Password FROM account WHERE UserName = '$username'";
//     $result = $conn->query($query);

//     if ($result->num_rows == 1) {
//         $row = $result->fetch_assoc();
//         $hashedPassword = $row['Password'];
//         return password_verify($password, $hashedPassword);
//     } else {
//         return false; 
//     }
// }


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = $_POST['username'] ?? '';
//     $password = $_POST['password'] ?? '';

//     if (empty($username) || empty($password)) {
//         $response = array('status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin');
//         echo json_encode($response);
//         exit();
//     }

//     if (isUsernameAndPasswordValid($conn, $username, $password)) {
//         $response = array('status' => 'success', 'message' => 'Đăng nhập thành công');
//     } else {
//         $response = array('status' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không chính xác');
//     }

//     echo json_encode($response);
// } else {
//     $response = array('status' => 'error', 'message' => 'Yêu cầu không hợp lệ');
//     echo json_encode($response);
// }
?>
