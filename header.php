<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="./scss/Global.css">
    <link rel="stylesheet" href="./scss/header.css">
    <script src="./js/header.js" defer></script>

    <style>
        .user-info{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="index.php" class="logo"> <i class="ri-store-2-line"></i>The 4Koffee</a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="#about">about</a>
            <a href="#popular">popular</a>
            <a href="#menu">menu</a>
            <a href="#order">order</a>
            <a href="#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="ri-menu-line"></div>
            <a href="search-btn" class="ri-search-line"></a>
            <a href="carts.php" class="ri-shopping-cart-line"></a>
            <?php
            // Start the session
            session_start();
            // Check if the user is logged in
            if (isset($_SESSION['accountId'])) {
                echo '<a class="user-info">Welcome, ' . $_SESSION['accountId'] . '</a>';
            } else {
                echo '<a href="./login.php">Login</a>';
            }
            ?>
        </div>

    </header>

</body>

<script>

    const userInfo = document.querySelector('.user-info');

    userInfo.addEventListener('click', function() {
        if (<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>) {
            
            var xhr = new XMLHttpRequest();
            
            xhr.open('GET', './logout.php', true);
            xhr.send();

            xhr.onload = function() {
                window.location.href = './login.php';
            };
        }
    });
</script>

</html>