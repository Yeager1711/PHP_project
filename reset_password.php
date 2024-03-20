<?php
require_once("./Database/configdb.php");

if (isset($_GET['token'])) {
    $resetToken = $_GET['token'];

    $queryCheckToken = "SELECT * FROM account WHERE ResetToken = '$resetToken'";
    $resultCheckToken = mysqli_query($conn, $queryCheckToken);

    if (mysqli_num_rows($resultCheckToken) > 0) {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
        </head>
        <body>
            <h2>Reset Password</h2>
            <form action="update_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo $resetToken; ?>">
                <label for="password">New Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit">Reset Password</button>
            </form>
        </body>
        </html>
<?php
    } else {
        echo "Invalid token.";
    }
} else {
    echo "Token not provided.";
}
?>
