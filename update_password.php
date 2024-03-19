<?php
require_once("./Database/configdb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resetToken = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($resetToken) || empty($password)) {
        echo "Please provide reset token and new password.";
        exit();
    }

    $queryCheckToken = "SELECT * FROM account WHERE ResetToken = '$resetToken'";
    $resultCheckToken = mysqli_query($conn, $queryCheckToken);

    if (mysqli_num_rows($resultCheckToken) > 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $queryUpdatePassword = "UPDATE account SET Password = '$hashedPassword', ResetToken = NULL WHERE ResetToken = '$resetToken'";
        if (mysqli_query($conn, $queryUpdatePassword)) {
            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Invalid token.";
    }
} else {
    echo "Invalid request.";
}
?>
