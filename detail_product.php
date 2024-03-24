<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details-product</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="./css/Global.css">
    <link rel="stylesheet" href="./css/detail.css">
</head>

<body>

    <section class="details">
     
    </section>


    <script src="js/detail.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 4.4, // Hiển thị 4 phần tử trên một lúc
          spaceBetween: 15, // Khoảng cách giữa các phần tử
          loop: true, // Lặp lại cuộn
          autoplay: {
            delay: 2300, // Tự động cuộn sau 3 giây
          },
          pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
          },
        });
      </script>
      
</body>

</html>
