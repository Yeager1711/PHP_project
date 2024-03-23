(function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./api/v1/menu/get_all_menu.php", true);
    xhr.responseType = "text";  // Đặt responseType thành "text" để nhận phản hồi dưới dạng văn bản
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var responseText = xhr.responseText;
            // Loại bỏ ký tự ?> từ phản hồi JSON
            responseText = responseText.replace("?>", "");

            var response = JSON.parse(responseText);

            var categorySection = document.querySelector("section.category");

            // Xóa tất cả các phần tử con hiện tại trong phần tử section.category
            while (categorySection.firstChild) {
                categorySection.firstChild.remove();
            }

            // Giới hạn số lượng sản phẩm menu là 7
            var limitedResponse = response.slice(0, 7);

            // Tạo các phần tử HTML mới từ dữ liệu JSON giới hạn
            limitedResponse.forEach(function(menu) {
                var box = document.createElement("a");
                box.href = "#";
                box.className = "box";

                var img = document.createElement("img");
                img.src = menu.Image;
                img.alt = "";

                var h3 = document.createElement("h3");
                h3.textContent = menu.MenuName;

                box.appendChild(img);
                box.appendChild(h3);
                categorySection.appendChild(box);
            });
        }
    };
    xhr.send();
})();