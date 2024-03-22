function submitRegisterForm() {
    var registerForm = document.getElementById('registerForm');
    var submitBtn = document.querySelector('.btn-submitRegister');

    submitBtn.addEventListener('click', function() {
        var fullName = document.getElementById('fullNameInput').value;
        var userName = document.getElementById('userNameInput').value;
        var password = document.getElementById('passwordInput').value;
        var email = document.getElementById('emailInput').value;

        var data = {
            FullName: fullName,
            UserName: userName,
            Password: password,
            Email: email,
            RoleID: ""
        };

        // Gửi dữ liệu đến API
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './api/v1/create_account.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert('Đăng ký thành công!');
                    window.location.href = "./index.php";
                } else {
                    alert('Đăng ký thất bại!');
                    // Thực hiện các hành động sau khi đăng ký thất bại
                }
            }
        };
        xhr.send(JSON.stringify(data));
    });
}

document.addEventListener('DOMContentLoaded', function() {
    submitRegisterForm();
});