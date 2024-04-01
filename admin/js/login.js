function submitLoginForm(event) {
    event.preventDefault(); // Ngăn chặn reload trang khi submit form

    // Lấy giá trị từ các trường nhập liệu
    var UserName = document.getElementById('userNameInput').value;
    var Password = document.getElementById('passwordInput').value;

    // Tạo đối tượng XMLHttpRequest để gửi yêu cầu HTTP
    var xhr = new XMLHttpRequest();

    // Thiết lập phương thức và đường dẫn của yêu cầu
    xhr.open('POST', './../api/v1/account/admin/login_account.php', true);

    // Thiết lập tiêu đề yêu cầu (nếu cần)
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Xử lý sự kiện khi yêu cầu hoàn thành
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Xử lý dữ liệu trả về từ API
            var responseData = JSON.parse(xhr.responseText);
            console.log(responseData); // Ví dụ: in ra dữ liệu trả về từ API

            if (responseData.status === 'success') {
                // Chuyển hướng đến trang index.html
                window.location.href = 'index.html';
            } else {
                console.error('Đăng nhập không thành công');
            }
        } else {
            console.error('Có lỗi xảy ra khi gọi API');
        }
    };

    // Gửi yêu cầu với dữ liệu là JSON chứa username và password
    var data = JSON.stringify({ UserName: UserName, Password: Password });
    xhr.send(data);
}

// Gán hàm submitLoginForm vào sự kiện "submit" của form
var form = document.getElementById('loginForm');
form.addEventListener('submit', submitLoginForm);