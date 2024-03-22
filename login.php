<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./css/Global.css">
    <link rel="stylesheet" href="./css/login.css">

</head>
<body>
    
    <div class="wrapper-login">
        <div class="wrapper-container">
            <form action="">
                <h3>Đăng nhập tài khoản</h3>
                <div class="box">
                    <span>User name</span>
                    <input type="text" placeholder="Enter your username..." name="userName" id="userNameInput" required>
                </div>
                <div class="box">
                    <span>Password</span>
                    <input type="text" placeholder="Enter your password..." name="password" id="passwordInput" required>
                </div>
                
                <div class="controller-btn">
                    <a href="./register.php">Chưa có tài khoản? Click đăng ký!</a>
                    <button type="button" class="btn-submitLogin" onclick=submitLoginForm()>
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="js/login.js"></script>

</html>