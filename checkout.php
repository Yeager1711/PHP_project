<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="./scss/Global.css">
    <link rel="stylesheet" href="./scss/checkout.css">
</head>

<body onload="loadCartItems()">
    <div class="checkout">
        <div class="checkout-container">
            <div class="header-checkout">
                <div class="status">
                    <h3>Orders</h3>
                    <div class="status-action">
                        <div class="shop">
                            <a href="index.php">
                                <i class="fa-solid fa-shop"></i>
                            </a>
                        </div>
                        <div class="cart">
                            <a href="carts.php">
                                <i class="fa-solid fa-cart-shopping arrow-status"></i>
                            </a>
                        </div>
                        <div class="checkout">
                            <i class="fa-regular fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
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
                    </div>
                    <div class="value-items">
                        <h3>Orders totals</h3>
                        <div class="value">
                            <div class="subtotal">
                                <span>Subtotal:</span>
                                <p id="subtotal">loading...</p>
                            </div>
                            <div class="tax">
                                <span>Tax:</span>
                                <p>10%</p>
                            </div>
                            <!-- <div class="table">
                                <span>Table:</span>
                                <p>Bàn 01</p>
                            </div> -->
                            <div class="total">
                                <span>Total:</span>
                                <p id="total">loading...</p>
                            </div>
                        </div>
                    </div>
                        
                    <div class="btn-checkout">
                        <a href="./checkout.html">
                            Proceed to checkout</a>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>

    <script>
        function loadCartItems() {
            const cartList = document.querySelector('.list-items tbody');
            console.log('cart list ', cartList);
            cartList.innerHTML = '';

            const username = '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'guest'; ?>';
            const cart = JSON.parse(sessionStorage.getItem('cart_' + username) || '[]');
            console.log('cart:', cart);


            cart.forEach((item) => {
                console.log('Processing item:', item);
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

            const subtotal = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
            const total = subtotal * 1.1;

            document.getElementById('subtotal').textContent = subtotal.toFixed(3) + 'đ';
            document.getElementById('total').textContent = total.toFixed(3) + 'đ';
        }
    </script>

</body>

</html>