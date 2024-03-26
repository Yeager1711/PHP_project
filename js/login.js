function submitLoginForm() {
    var registerForm = document.getElementById('registerForm');
    var submitBtn = document.querySelector('.btn-submitLogin');

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
                    alert('Đăng nhập thành công!');
                    window.location.href = "./index.php";
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
