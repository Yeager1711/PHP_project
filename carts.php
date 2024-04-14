<?php
session_start();

if (isset($_SESSION['username'])) {
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $cart = $_SESSION['cart'];
} else {
  header('Location: login.php');
  exit;
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

           <button class="btn-update">Cập nhật</button>

          </div>

          <div class="value-items">
            <h3>Cart totals</h3>
            <div class="value">
              <div class="subtotal">
                <span>subtotal:</span>
                <p>loading...</p>
              </div>

              <div class="total">
                <span>total:</span>
                <p>loading...</p>
              </div>

              <div class="table">
                  <span>Bàn:</span>
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
                <a href="./checkout.php">
                  Proceed to checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

<script>
  const selectTable = document.querySelector('select[name="number_of_tables"]');

  const btnCheckout = document.querySelector('.btn-checkout');

  btnCheckout.addEventListener('click', () => {
    const selectedTable = selectTable.value; // Lấy giá trị của bàn đã chọn

    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    console.log('user' + username);
    const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');
    const encodedCart = encodeURIComponent(JSON.stringify(cart));
    sessionStorage.setItem('selected_table_' + username, selectedTable);
    console.log('selected_table_' + username, selectedTable)

    window.location.href = `./checkout.php?cart=${encodedCart}`;
  });

  function loadCartItems() {
    const cartList = document.querySelector('.list-items tbody');
    cartList.innerHTML = '';

    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');

    console.log('Cart:', cart);

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
        <td class="item-total">${(item.price * item.quantity).toFixed(3)}đ</td>
      `;

      
      cartList.appendChild(row);
    });
  }

  //  ====================================================================================================================
  window.onload = function() {
    const cartList = document.querySelector('.list-items tbody');
    const subtotalElements = document.querySelectorAll('.subtotal p');
    const totalElement = document.querySelector('.total p');
    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    calculateTotal();
    loadCartItems();
    

    // Thêm sự kiện click cho biểu tượng X
    cartList.addEventListener('click', function(event) {
      if (event.target.classList.contains('fa-xmark')) {
        console.log('X button clicked');

        const row = event.target.closest('tr');
        const rowName = row.querySelector('td:nth-child(3)').textContent;
        const rowSize = row.querySelector('td:nth-child(4)').textContent;
        const rowTopping = row.querySelector('td:nth-child(5)').textContent;
        const rowPrice = parseFloat(row.querySelector('td:nth-child(6)').textContent.replace('đ', ''));
        const rowQuantity = parseInt(row.querySelector('td:nth-child(7) input').value);

        const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
        const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');

        const index = cart.findIndex(item => {
          return item.name === rowName && item.size === rowSize && item.topping === rowTopping && item.price === rowPrice && item.quantity === rowQuantity;
        });

        // Xóa sản phẩm khỏi giỏ hàng
        if (index !== -1) {
          cart.splice(index, 1);
          sessionStorage.setItem('cart_' + username, JSON.stringify(cart));
          loadCartItems();
          calculateTotal();
        }
      }
    });

    //xử lý không cho chọn số lượng âm
    const quantityInputs = document.querySelectorAll('input[type="number"]');

    quantityInputs.forEach(input => {
      input.addEventListener('input', () => {
        if (input.value < 1) {
          input.value = 1;
        }
      });
    });

    // Thêm sự kiện click cho nút "Cập nhật"
    const updateButton = document.querySelector('.btn-update');
    updateButton.addEventListener('click', updateCart);

    // Thêm sự kiện change cho các input số lượng
    cartList.addEventListener('change', function(event) {
      if (event.target.nodeName === 'INPUT' && event.target.type === 'number') {
        updateCart();
      }
    });

    function updateCart() {
      const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');
      const updatedCart = [];

      cartList.querySelectorAll('tr').forEach(row => {
        const rowName = row.querySelector('td:nth-child(3)').textContent;
        const rowSize = row.querySelector('td:nth-child(4)').textContent;
        const rowTopping = row.querySelector('td:nth-child(5)').textContent;
        const rowPrice = parseFloat(row.querySelector('td:nth-child(6)').textContent.replace('đ', ''));
        const rowQuantity = parseInt(row.querySelector('td:nth-child(7) input').value);

        const itemIndex = cart.findIndex(item => item.name === rowName && item.size === rowSize && item.topping === rowTopping && item.price === rowPrice);

        if (itemIndex !== -1) {
          cart[itemIndex].quantity = rowQuantity;
          updatedCart.push(cart[itemIndex]);

          // Cập nhật giá trị tổng cho hàng đó
          const itemTotal = row.querySelector('.item-total');
          itemTotal.textContent = (rowPrice * rowQuantity).toFixed(3) + 'đ';
        }
      });

      sessionStorage.setItem('cart_' + username, JSON.stringify(updatedCart));
      calculateTotal();
    }

    function calculateTotal() {
      const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');
  let subtotal = 0;

  cart.forEach(item => {
    let itemPrice = item.price;

    // Tính phụ phí cho kích thước
    if (item.size === 'Vừa + 10.000đ') {
      itemPrice += 10.000;
    } else if (item.size === 'Lớn + 15.000đ') {
      itemPrice += 15.000;
    }

    // Tính phụ phí cho topping
    const toppingPrice = parseFloat(item.topping.split('+')[1]) || 0;
    itemPrice += toppingPrice;

    const itemSubtotal = itemPrice * item.quantity;
    subtotal += itemSubtotal;
  });

  // Hiển thị tổng giỏ hàng và tổng cộng
  subtotalElements.forEach(element => {
    element.textContent = subtotal.toFixed(3) + " vnđ";
  });
  totalElement.textContent = subtotal.toFixed(3) + " vnđ";
  }
  };
</script>

</html>