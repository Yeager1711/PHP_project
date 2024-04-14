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
  const btnCheckout = document.querySelector('.btn-checkout');

  btnCheckout.addEventListener('click', () => {
    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    console.log('user' + username);
    const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');
    const encodedCart = encodeURIComponent(JSON.stringify(cart));
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
      <td>${(item.price * item.quantity).toFixed(3)}đ</td>
    `;

      cartList.appendChild(row);
    }
    );
  }

  //  ====================================================================================================================
  window.onload = function() {
    const cartList = document.querySelector('.list-items tbody');
    const subtotalElements = document.querySelectorAll('.subtotal p');
    const totalElement = document.querySelector('.total p');
    const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
    loadCartItems();

    // Thêm sự kiện click cho biểu tượng X
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

    // Thêm sự kiện click cho nút "Cập nhật"
    const updateButton = document.querySelector('.btn-update');
    updateButton.addEventListener('click', updateCart);

    function updateCart() {
      const cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
      const updatedCart = [];
      let subtotal = 0;

      cartList.querySelectorAll('tr').forEach(row => {
        const rowName = row.querySelector('td:nth-child(3)').textContent;
        const rowSize = row.querySelector('td:nth-child(4)').textContent;
        const rowTopping = row.querySelector('td:nth-child(5)').textContent;
        const rowPrice = parseFloat(row.querySelector('td:nth-child(6)').textContent.replace('đ', ''));
        const rowQuantity = parseInt(row.querySelector('td:nth-child(7) input').value);

        let itemIndex = cart.findIndex(item => item.name === rowName && item.size === rowSize && item.topping === rowTopping && item.price === rowPrice);

        if (itemIndex !== -1) {
          cart[itemIndex].quantity = rowQuantity; 
          updatedCart.push(cart[itemIndex]);
        }
      });

      sessionStorage.setItem('cart', JSON.stringify(updatedCart));
      loadCartItems();
      calculateTotal();
    }

    function calculateTotal() {
      const cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
      console.log(sessionStorage.getItem('cart'));
      let subtotal = 0;

      cart.forEach(item => {
        subtotal += item.price * item.quantity;
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