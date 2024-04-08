 // Gọi API để lấy dữ liệu CateID
 fetch('../api/v1/category/get_all_category.php')
 .then(response => response.json())
 .then(data => {
     // Duyệt qua từng mục trong dữ liệu API và thêm vào ô CateID
     data.forEach(item => {
         const option = document.createElement('option');
         option.value = item.CateID; // Giả sử CateID được trả về từ API là thuộc tính "cateID"
         option.text = item.CateName; // Giả sử cateName là tên hiển thị cho mỗi tùy chọn
         document.getElementById('cateID').appendChild(option);
     });
 })
 .catch(error => {
     console.error('Lỗi khi gọi API:', error);
 });

// Xử lý sự kiện khi nhấn vào nút "Add"
document.getElementById('addButton').addEventListener('click', function() {
 // Lấy giá trị từ các trường nhập liệu
 var dishName = document.getElementById('dishName').value;
 var price = document.getElementById('price').value;
 var description = document.getElementById('description').value;
 var amount = document.getElementById('amount').value;
 var image = document.getElementById('image').value;
 var status = document.getElementById('status').value;
 var cateID = document.getElementById('cateID').value;

 // Tạo đối tượng dữ liệu để gửi lên server
 var data = {
     DishName: dishName,
     Price: price,
     Description: description,
     Amount: amount,
     Image: image,
     Status: status,
     CateID: cateID
 };

 // Gửi yêu cầu POST đến API
 fetch('../api/v1/dish/create_dish.php', {
     method: 'POST',
     headers: {
         'Content-Type': 'application/json'
     },
     body: JSON.stringify(data)
 })
 .then(function(response) {
     return response.json();
 })
 .then(function(data) {
     // Xử lý kết quả từ API
     console.log(data); // In kết quả trong console
     // Thực hiện các hành động khác sau khi thêm mới sản phẩm thành công
 })
 .catch(function(error) {
     console.error('Lỗi:', error);
 });
});