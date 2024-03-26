fetch('./api/v1/dish/get_all_drinks.php')
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
        addToCartButton.innerText = 'Thêm vào giỏ hàng';

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