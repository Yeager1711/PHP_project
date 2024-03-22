document.addEventListener("DOMContentLoaded", function() {
    // Gán sự kiện click cho nút "Đăng ký"
    var registerButton = document.querySelector(".btn-submitRegister");
    registerButton.addEventListener("click", submitRegisterForm);
});
function submitRegisterForm() {
    var fullName = document.querySelector('input[name="fullName"]').value;
    var userName = document.querySelector('input[name="userName"]').value;
    var password = document.querySelector('input[name="password"]').value;
    var email = document.querySelector('input[name="email"]').value;

    // Kiểm tra xem các trường có được điền đầy đủ không
    if (fullName === "" || userName === "" || password === "" || email === "") {
        alert("Vui lòng điền đầy đủ thông tin.");
        return;
    }

    var data = {
        FullName: fullName,
        UserName: userName,
        Password: password,
        Email: email,
        RoleID: ""
    };

    fetch("http://localhost:8080/bookingcoffee/api/v1/accounts.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        if (result.status === "success") {
            // Chuyển hướng đến trang login.html
            window.location.href = "./login.html";
        } else {
            window.location.href = "./index.html";
        }
    })
    .catch(error => {
        console.error(error);
        // Xử lý lỗi (ví dụ: hiển thị thông báo lỗi)
    });
}