<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4Koffe Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="./scss/Global.css">
    <link rel="stylesheet" href="./scss/home.css">
    <script src="./js/home.js" defer></script>
</head>

<body>

    <!-- header -->
    <?php
    include_once('header.php');
    ?>
    <!-- ------ -->

    <section class="home" id="home">
        <div class="image">
            <img src="image/banner-3.jpg" alt="" class="home-img">

            <div class="content">
                <span>Welcome to The Garden Cafe</span>
                <h3>Where Fresh Flavors And Come Together.</h3>
                <p>Experience fresh, farm-to-table cuisine in our garden-inspired cafe. Come for the food, stay for the
                    atmosphere.</p>
                <a href="#popular" class="btn">order now</a>
            </div>
        </div>

    </section>

    <section class="product">
        <div class="product-container">
            <!-- Coffee -->

            <div class="banner">
                <div class="image">
                    <img src="./image/product-banner.jpg" alt="">
                </div>

                <div class="product-list">
                    <div class="box">
                        <div class="image-product">
                            <img src="./image/product-1.jpg" alt="">
                        </div>

                        <div class="content">
                            <span>CloudFee hạnh nhân nướng</span>
                            <span>49.000đ</span>
                        </div>
                    </div>

                    <div class="box">
                        <div class="image-product">
                            <img src="./image/product-1.jpg" alt="">
                        </div>

                        <div class="content">
                            <span>CloudFee hạnh nhân nướng</span>
                            <span>49.000đ</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="list-CoffeContainer">
                <div class="header-title">
                    <div class="title">
                        <h3 class="title-header">Danh sách Coffee</h3>
                    </div>

                    <div class="box-search">
                        <input type="text">
                        <button>Tìm</button>
                    </div>
                </div>

                <?php
                // Kiểm tra xem đã gửi yêu cầu tìm kiếm chưa
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    // Gọi API để lấy danh sách sản phẩm theo từ khóa tìm kiếm
                    $url = 'http://your_domain/get_all_dish.php?query=' . urlencode($search); // Thay đổi đường dẫn API của bạn
                    $data = file_get_contents($url);
                    $products = json_decode($data, true);

                    // Hiển thị danh sách sản phẩm
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo '<div class="box">';
                            echo '<div class="image-product">';
                            echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
                            echo '</div>';
                            echo '<div class="content">';
                            echo '<span>' . $product['name'] . '</span>';
                            echo '<span>' . $product['price'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Không tìm thấy sản phẩm.";
                    }
                }
                ?>


                <div class="swiper mySwiper">
                    <div class="swiper-wrapper" id="productList">

                    </div>
                </div>
            </div>

            <div class="list-TeaContainer">
                <h3 class="title-header">Danh sách Trà</h3>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper" id="teaProductList"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Lắng nghe sự kiện khi nhập từ khóa tìm kiếm
        document.querySelector('input[type="text"]').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase(); // Lấy từ khóa tìm kiếm và chuyển thành chữ thường

            // Lặp qua tất cả các sản phẩm trong swiper
            var swiperSlides = document.querySelectorAll('.swiper-slide');
            swiperSlides.forEach(function(slide) {
                var productName = slide.querySelector('.content span:first-child').innerText.toLowerCase(); // Lấy tên sản phẩm và chuyển thành chữ thường
                // Kiểm tra xem sản phẩm có chứa từ khóa tìm kiếm không
                if (productName.includes(searchTerm)) {
                    slide.style.display = 'block'; // Hiển thị sản phẩm nếu chứa từ khóa tìm kiếm
                } else {
                    slide.style.display = 'none'; // Ẩn sản phẩm nếu không chứa từ khóa tìm kiếm
                }
            });
        });


        fetch('./api/v1/dish/get_dish_by_category.php?CateID=7b474708-86f5-4404-94ef-ac1cb8504bba')
            .then(response => response.json())
            .then(data => {
                // Lặp qua dữ liệu nhận được từ API và tạo HTML tương ứng
                data.forEach(dish => {
                    // Tạo một thẻ swiper-slide mới
                    var swiperSlide = document.createElement('div');
                    swiperSlide.classList.add('swiper-slide');

                    // Tạo HTML cho sản phẩm
                    var productBox = document.createElement('div');
                    productBox.classList.add('box');

                    var productImage = document.createElement('div');
                    productImage.classList.add('image-product');

                    var image = document.createElement('img');
                    image.src = dish.Image;
                    image.alt = '';

                    productImage.appendChild(image);

                    var productContent = document.createElement('div');
                    productContent.classList.add('content');

                    var productName = document.createElement('span');
                    productName.innerText = dish.DishName;

                    var productPrice = document.createElement('span');
                    productPrice.innerText = dish.Price + 'đ';

                    var addToCartButton = document.createElement('div');
                    addToCartButton.classList.add('btn-addToCart');
                    addToCartButton.innerText = 'Xem sản phẩm';

                    // Event listener for the button to redirect to detail_product.php
                    addToCartButton.addEventListener('click', function() {
                        window.location.href = '/bookingcoffee/detail-dish.php?DishID=' + dish.DishID;
                    });

                    productContent.appendChild(productName);
                    productContent.appendChild(productPrice);
                    productContent.appendChild(addToCartButton);

                    productBox.appendChild(productImage);
                    productBox.appendChild(productContent);

                    swiperSlide.appendChild(productBox);

                    // Thêm swiper-slide mới vào swiper-wrapper hiện tại
                    var swiperWrapper = document.querySelector('.swiper-wrapper');
                    swiperWrapper.appendChild(swiperSlide);
                });
            })
            .catch(error => console.log(error));

        // =================================================================================================================

        fetch('./api/v1/dish/get_dish_by_category.php?CateID=42b4f591-ee08-4614-a180-c7b3b840a535')
            .then(response => response.json())
            .then(data => {
                // Lặp qua dữ liệu nhận được từ API và tạo HTML tương ứng
                data.forEach(dish => {
                    // Tạo một thẻ swiper-slide mới
                    var swiperSlide = document.createElement('div');
                    swiperSlide.classList.add('swiper-slide');

                    // Tạo HTML cho sản phẩm
                    var productBox = document.createElement('div');
                    productBox.classList.add('box');

                    var productImage = document.createElement('div');
                    productImage.classList.add('image-product');

                    var image = document.createElement('img');
                    image.src = dish.Image;
                    image.alt = '';

                    productImage.appendChild(image);

                    var productContent = document.createElement('div');
                    productContent.classList.add('content');

                    var productName = document.createElement('span');
                    productName.innerText = dish.DishName;

                    var productPrice = document.createElement('span');
                    productPrice.innerText = dish.Price + 'đ';

                    var addToCartButton = document.createElement('div');
                    addToCartButton.classList.add('btn-addToCart');
                    addToCartButton.innerText = 'Xem sản phẩm';

                    // Event listener for the button to redirect to detail_product.php
                    addToCartButton.addEventListener('click', function() {
                        window.location.href = '/bookingcoffee/detail-dish.php?DishID=' + dish.DishID;
                    });

                    productContent.appendChild(productName);
                    productContent.appendChild(productPrice);
                    productContent.appendChild(addToCartButton);

                    productBox.appendChild(productImage);
                    productBox.appendChild(productContent);

                    swiperSlide.appendChild(productBox);

                    // Thêm swiper-slide mới vào swiper-wrapper hiện tại
                    var swiperWrapper = document.getElementById('teaProductList');
                    swiperWrapper.appendChild(swiperSlide);
                });
            })
            .catch(error => console.log(error));
    </script>

    <section class="blogs">
        <div class="blog-container">
            <div class="image-blogs">
                <div class="image">
                    <img src="./image/blog-2.jpg" alt="">
                </div>

                <div class="content">
                    <h2>The 4Koffee</h2>
                    <span>Nơi cuộc hẹn và trãi nghiệm đầy với đặc sản.</span>
                    <p> Món ăn đa dạng bản sắc và không gian cảm hứng</p>
                </div>
            </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="box">
                <h3>Giới thiệu</h3>
                <a href="">Home</a>
                <a href="">Blog</a>
                <a href="">About</a>
                <a href="">Popular</a>
                <a href="">Menu</a>
                <a href="">Order</a>
            </div>

            <div class="box">
                <h3>Điều khoản</h3>
                <a href="">Điều khoản sử dụng</a>
                <a href="">Chính sách</a>
            </div>

            <div class="box">
                <h3>Liên hệ</h3>
                <a href="">Đặt hàng: 0xxx4098xx</a>
                <a href="">Địa chỉ:
                    <p>475 Điện Biên Phủ, P25, Quận Bình Thạnh, TP. Hồ Chí Minh</p>
                </a>
            </div>
        </div>
    </footer>



</body>



</html>