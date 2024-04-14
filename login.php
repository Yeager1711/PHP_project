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
                    <input type="password" placeholder="Enter your password..." name="password" id="passwordInput" required>
                </div>

                <div class="controller-btn">
                    <a href="./register.php">Chưa có tài khoản? Click đăng ký!</a>
                    <button type="button" class="btn-login" onclick=submitLoginForm()>
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    function submitLoginForm() {
        var registerForm = document.getElementById('registerForm');
        var submitBtn = document.querySelector('.btn-login');

        submitBtn.addEventListener('click', function() {

            var userName = document.getElementById('userNameInput').value;
            var password = document.getElementById('passwordInput').value;

            var data = {
                UserName: userName,
                Password: password
            };

            // Gửi dữ liệu đến API
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './api/v1/account/login_account.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                       
                        window.location.href = "../bookingcoffee/index.php";
                    } else {
                        alert('Đăng nhập thất bại!');
                        window.location.href = "./login.php";
                    }
                }
            };
            xhr.send(JSON.stringify(data));
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        submitLoginForm();
    });



    
</script>

</html>