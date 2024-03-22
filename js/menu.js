(function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./api/v1/menu/get_all_menu.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var categorySection = document.querySelector("section.category");

            // Xóa tất cả các phần tử con hiện tại trong phần tử section.category
            while (categorySection.firstChild) {
                categorySection.firstChild.remove();
            }

            // Tạo các phần tử HTML mới từ dữ liệu JSON, giới hạn chỉ hiển thị 7 menu
            response.slice(0, 7).forEach(function(menu) {
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