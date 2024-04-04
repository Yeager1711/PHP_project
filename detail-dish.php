<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details-product</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="./css/Global.css">
    <link rel="stylesheet" href="./scss/detail.css">
    <!-- <script src="./js/details.js" defer></script> -->
    <style>
        .selected,
        .topping-selected {
            background-color: #27ae60;
            font-weight: bold;
            color: #fff;

        }

        .required {
            color: red;
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET["DishID"])) {
        $dishID = $_GET["DishID"];
    } else {
        echo "Không tìm thấy DishID!";
        exit;
    }
    ?>

    <div class="details">
        <div class="detail-container">
            <div class="image">
                <img src="" id="productImage" alt="">
            </div>

            <div class="content">
                <h3 class="drinkName" id="productName"></h3>
                <span class="menu" id="productType">Loại: <p></p></span>
                <span class="price" id="productPrice">
                    Giá:
                    <p></p>
                </span>

                <div class="choose-size">
                    <h3>Chọn size <span class="required">*</span></h3>

                    <div class="wrapper-size">
                        <span class="size-option" data-price="0">Nhỏ + 0đ</span>
                        <span class="size-option" data-price="10000">Vừa + 10.000đ</span>
                        <span class="size-option" data-price="15000">Lớn + 15.000đ</span>
                    </div>
                </div>

                <div class="choose-topping">
                    <h3>Chọn topping <span class="required">*</span></h3>

                    <div class="wrapper-sizeTopping">

                    </div>
                </div>

                <div class="quantity-selector">
                    <button class="quantity-btn decrease-btn">-</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="quantity-btn increase-btn">+</button>
                </div>

                <button class="btn-addToCart">
                    Thêm vào giỏ hàng
                </button>
            </div>
        </div>

        <section class="describle">
            <h3 class="title-header">Mô tả sản phẩm</h3>
            <p id="productDescription">

            </p>
        </section>

        <div class="container-list-product">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper" id="relatedProducts">
                    <!-- Các sản phẩm liên quan sẽ được cập nhật bằng JavaScript -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        // Lấy danh sách các thẻ chọn size
        const sizeOptions = document.querySelectorAll('.size-option');

        // Thêm sự kiện click cho mỗi thẻ
        sizeOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Xóa hiệu ứng đã chọn trước đó
                sizeOptions.forEach(option => {
                    option.classList.remove('selected');
                });

                // Thêm hiệu ứng cho thẻ được click
                option.classList.add('selected');

                // Lấy giá tiền từ thuộc tính data-price
                const price = option.getAttribute('data-price');
                console.log('Giá tiền: ' + price);

                // Thực hiện các xử lý khác sau khi chọn size
                // ...
            });
        });



        fetch('./api/v1/dish/get_dish_by_id.php?DishID=<?php echo $_GET["DishID"]; ?>')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const productImage = document.getElementById('productImage');
                const productName = document.getElementById('productName');
                const productType = document.getElementById('productType');
                const productPrice = document.getElementById('productPrice');
                const productDescription = document.getElementById('productDescription');

                if (Array.isArray(data) && data.length > 0) {
                    const firstDish = data[0];

                    // Lấy danh sách danh mục từ một API khác
                    fetch('./api/v1/category/get_all_category.php')
                        .then(response => response.json())
                        .then(categoryData => {
                            // Tạo một đối tượng ánh xạ CateID với CateName
                            const categoryMap = {};
                            categoryData.forEach(category => {
                                categoryMap[category.CateID] = category.CateName;
                            });

                            // Lấy tên loại từ danh sách danh mục ánh xạ với CateID
                            const categoryName = categoryMap[firstDish.CateID] || '';

                            // Gán tên loại vào productType
                            productType.innerHTML = 'Loại: <p>' + categoryName + '</p>';
                        })
                        .catch(error => console.log(error));

                    productImage.src = firstDish.Image || '';
                    productName.innerText = firstDish.DishName || '';
                    productPrice.innerHTML = 'Giá: <p>' + (firstDish.Price || '') + 'đ</p>';
                    productDescription.innerText = firstDish.Description || '';
                } else {
                    console.log('Mảng dữ liệu trả về rỗng hoặc không hợp lệ.');
                }
            })
            .catch(error => console.log(error));


        const toppingContainer = document.querySelector('.wrapper-sizeTopping');

        fetch('./api/v1/topping/get_all_topping.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(topping => {
                    const toppingOption = document.createElement('span');
                    toppingOption.textContent = `${topping.Name} + ${topping.Price}đ`;
                    toppingContainer.appendChild(toppingOption);

                    toppingOption.addEventListener('click', () => {
                        const toppingOptions = toppingContainer.querySelectorAll('span');
                        toppingOptions.forEach(option => {
                            option.classList.remove('topping-selected');
                        });

                        toppingOption.classList.add('topping-selected');

                        console.log(`Topping được chọn: ${topping.Name} - Giá: ${topping.Price}đ`);

                    });
                });
            })
            .catch(error => console.log(error));



        const swiperWrapper = document.querySelector('.swiper-wrapper');

        fetch('./api/v1/category/get_all_category.php')
            .then(response => response.json())
            .then(categoryData => {
                const categoryMap = {};
                categoryData.forEach(category => {
                    categoryMap[category.CateID] = category.CateName;
                });

                fetch('./api/v1/dish/get_all_dish.php')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(dish => {
                            const swiperSlide = document.createElement('div');
                            swiperSlide.classList.add('swiper-slide');

                            const dishLink = document.createElement('a');
                            dishLink.href = `detail-dish.php?DishID=${dish.DishID}`;
                            dishLink.classList.add('box');

                            const imageDiv = document.createElement('div');
                            imageDiv.classList.add('image');

                            const image = document.createElement('img');
                            image.src = dish.Image;
                            image.alt = dish.DishName;

                            imageDiv.appendChild(image);

                            const infoDiv = document.createElement('div');
                            infoDiv.classList.add('info-drink');

                            const dishName = document.createElement('h3');
                            dishName.textContent = dish.DishName;

                            const dishType = document.createElement('span');
                            dishType.innerHTML = `Loại: <p>${categoryMap[dish.CateID]}</p>`;

                            infoDiv.appendChild(dishName);
                            infoDiv.appendChild(dishType);

                            dishLink.appendChild(imageDiv);
                            dishLink.appendChild(infoDiv);

                            swiperSlide.appendChild(dishLink);

                            swiperWrapper.appendChild(swiperSlide);
                        });

                        var swiper = new Swiper(".mySwiper", {
                            slidesPerView: 4,
                            spaceBetween: 15,
                            loop: true,
                            autoplay: {
                                delay: 2300,
                            },
                            pagination: {
                                el: ".swiper-pagination",
                                dynamicBullets: true,
                            },
                            breakpoints: {
                                420: {
                                    slidesPerView: 1.6,
                                    spaceBetween: 10,
                                },
                                768: {
                                    slidesPerView: 2.5,
                                    spaceBetween: 10,
                                },
                                992: {
                                    slidesPerView: 3.6,
                                    spaceBetween: 20,
                                },
                                1200: {
                                    slidesPerView: 3.8,
                                    spaceBetween: 30,
                                },
                            },
                        });
                    })
                    .catch(error => console.log(error));
            })
            .catch(error => console.log(error));

        const decreaseBtn = document.querySelector('.decrease-btn');
        const increaseBtn = document.querySelector('.increase-btn');
        const quantityInput = document.querySelector('.quantity-input');

        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    </script>

</body>

</html>