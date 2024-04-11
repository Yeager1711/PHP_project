<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
  // Kiểm tra xem giỏ hàng của người dùng đã được lưu trong phiên session hay chưa
  if (!isset($_SESSION['cart'])) {
    // Nếu chưa có giỏ hàng, tạo một giỏ hàng mới rỗng
    $_SESSION['cart'] = [];
  }

  // Lấy thông tin giỏ hàng từ phiên session
  $cart = $_SESSION['cart'];
} else {
  // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
  header('Location: login.php');
  exit; // Dừng việc thực thi mã PHP tiếp theo
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="./scss/Global.css">
  <link rel="stylesheet" href="./scss/cart.css">
</head>

<body>
  <div class="cart">
    <div class="cart-container">
      <div class="header-cart">

        <video autoplay muted loop class="header-video">
          <source src="video/coffe.mp4" type="video/mp4">
        </video>

        <div class="status">
          <h3>Cart</h3>
          <div class="status-action">
            <div class="shop">
              <a href="index.php">
                <i class="fa-solid fa-shop"></i>
              </a>
            </div>
            <div class="cart">
              <i class="fa-solid fa-cart-shopping arrow-status"></i>
            </div>
            <div class="checkout">
              <i class="fa-regular fa-credit-card"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container-items">
          <div class="list-items">
            <table>
              <thead>
                <tr>
                  <th></th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Size</th>
                  <th>Topping</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>

            <div class="btn-update">Cập nhật </div>
          </div>

          <div class="value-items">
            <h3>Cart totals</h3>

            <div class="value">
              <div class="subtotal">
                <span>hello:</span>
                <p>loading...</p>
              </div>
              <div class="subtotal">
                <span>subtotal:</span>
                <p>loading...</p>
              </div>

              <div class="total">
                <span>total:</span>
                <p>loading...</p>
              </div>

              <div class="table">
                <span>Table:</span>
                <select name="number_of_tables">
                  <option value="1">Bàn 01</option>
                  <option value="2">Bàn 02</option>
                  <option value="3">Bàn 03</option>
                  <option value="4">Bàn 04</option>
                  <option value="5">Bàn 05</option>
                  <option value="6">Bàn 06</option>
                  <option value="7">Bàn 07</option>
                  <option value="8">Bàn 08</option>
                  <option value="9">Bàn 09</option>
                  <option value="10">Bàn 010</option>
                </select>
              </div>


              <div class="btn-checkout">
                <a href="./checkout.html">
                  Proceed to checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

<script>
  window.onload = function() {
    const cartList = document.querySelector('.list-items tbody');
    const subtotalElements = document.querySelectorAll('.subtotal p');
    const totalElement = document.querySelector('.total p');
    const tableSelect = document.querySelector('select[name="number_of_tables"]');
    loadCartItems();

    // Thêm sự kiện click cho biểu tượng X
    cartList.addEventListener('click', function(event) {
      if (event.target.classList.contains('fa-xmark')) {
        const row = event.target.closest('tr');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');

        // Tìm chỉ mục của sản phẩm cần xóa trong giỏ hàng
        const index = cart.findIndex(item => {
          const rowName = row.querySelector('td:nth-child(3)').textContent;
          const rowSize = row.querySelector('td:nth-child(4)').textContent;
          const rowTopping = row.querySelector('td:nth-child(5)').textContent;
          const rowPrice = parseFloat(row.querySelector('td:nth-child(6)').textContent.replace('đ', ''));
          const rowQuantity = parseInt(row.querySelector('td:nth-child(7) input').value);

          return item.name === rowName && item.size === rowSize && item.topping === rowTopping && item.price === rowPrice && item.quantity === rowQuantity;
        });

        // Xóa sản phẩm khỏi giỏ hàng
        if (index !== -1) {
          cart.splice(index, 1);
          localStorage.setItem('cart', JSON.stringify(cart));
          loadCartItems();
          calculateTotal();
        }
      }
    });

    // Thêm sự kiện click cho nút "Cập nhật"
    const updateButton = document.querySelector('.btn-update');
    updateButton.addEventListener('click', updateCart);

    // Tính toán và hiển thị tổng
    function calculateTotal() {
      const cart = JSON.parse(localStorage.getItem('cart') || '[]');
      let subtotal = 0;

      cart.forEach(item => {
        subtotal += item.price * item.quantity;
      });

      const tableValue = parseFloat(tableSelect.value);
      const total = subtotal + tableValue;

      subtotalElements.forEach(element => {
        element.textContent = subtotal.toFixed(3) + " vnđ";
      });
      totalElement.textContent = total.toFixed(3) + " vnđ";
    }

    // Cập nhật giỏ hàng
    function updateCart() {
      const cart = JSON.parse(localStorage.getItem('cart') || '[]');
      const updatedCart = [];
      let subtotal = 0;

      cartList.querySelectorAll('tr').forEach(row => {
        const rowName = row.querySelector('td:nth-child(3)').textContent;
        const rowSize = row.querySelector('td:nth-child(4)').textContent;
        const rowTopping = row.querySelector('td:nth-child(5)').textContent;
        const rowPrice = parseFloat(row.querySelector('td:nth-child(6)').textContent.replace('đ', ''));
        const rowQuantity = parseInt(row.querySelector('td:nth-child(7) input').value);

        const item = cart.find(item => item.name === rowName && item.size === rowSize && item.topping === rowTopping && item.price === rowPrice);

        if (item) {
          item.quantity = rowQuantity;
          updatedCart.push(item);
          subtotal += item.price * item.quantity;
        }
      });

      localStorage.setItem('cart', JSON.stringify(updatedCart));
      loadCartItems();
      calculateTotal();
    }
  };

  function loadCartItems() {
    const cartList = document.querySelector('.list-items tbody');
    cartList.innerHTML = '';

    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');


    cart.forEach((item) => {
      const row = document.createElement('tr');

      row.innerHTML = `
      <td><i class="fa-solid fa-xmark"></i></td>
      <td><img src="${item.image}" alt="${item.name}"></td>
      <td>${item.name}</td>
      <td>${item.size}</td>
      <td>${item.topping}</td>
      <td>${item.price.toFixed(3)}đ</td>
      <td><input type="number" value="${item.quantity}"></td>
      <td>${(item.price * item.quantity).toFixed(3)}đ</td>
    `;

      cartList.appendChild(row);
    });
  }
</script>

</html>