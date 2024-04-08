// function isValidEmail(email) {
//     // Biểu thức chính quy để kiểm tra định dạng email
//     var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return emailPattern.test(email);
// }

function submitRegisterForm() {
    var registerForm = document.getElementById('registerForm');
    var submitBtn = document.querySelector('.btn-submitRegister');

    submitBtn.addEventListener('click', function() {
        var fullName = document.getElementById('fullNameInput').value;
        var userName = document.getElementById('userNameInput').value;
        var password = document.getElementById('passwordInput').value;
        var email = document.getElementById('emailInput').value;

        // Kiểm tra định dạng email trước khi gửi dữ liệu
        // if (!isValidEmail(email)) {
        //     document.getElementById('error-message').innerText = 'Định dạng email không hợp lệ';
        //     return;
        // }

        var data = {
            FullName: fullName,
            UserName: userName,
            Password: password,
            Email: email,
            RoleID: ""
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './api/v1/account/register_account.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert('Đăng ký thành công!');
                    window.location.href = "../bookingcoffee/login.php";
                } else {
                    document.getElementById('error-message').innerText = response.message;
                    document.getElementById('error-message').classList.add('active');
                }
            }
        };
        xhr.send(JSON.stringify(data));
    });
}

document.addEventListener('DOMContentLoaded', function() {
    submitRegisterForm();
});