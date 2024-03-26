<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="./css/Global.css">
    <link rel="stylesheet" href="./css/register.css">

</head>
<body>

    <div class="wrapper-register">
        <div class="wrapper-container">
            <form id="registerForm">
                <h3>Đăng ký tài khoản</h3>
                <div class="box">
                    <span>Full Name</span>
                    <input type="text" name="fullName" id="fullNameInput" required>
                </div>
                <div class="box">
                    <span>User name</span>
                    <input type="text" name="userName" id="userNameInput" required>
                </div>
                <div class="box">
                    <span>Password</span>
                    <input type="password" name="password" id="passwordInput" required>
                </div>
                <div class="box">
                    <span>Email</span>
                    <input type="email" name="email" id="emailInput" required>
                </div>
                <div class="controller-btn">
                    <a href="./login.php">Đăng nhập</a>
                    <button type="button" class="btn-submitRegister" onclick=submitRegisterForm()>
                        Đăng ký
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="js/register.js"></script>

</html>