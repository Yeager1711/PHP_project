var swiper = new Swiper(".mySwiper", {
  slidesPerView: 4,
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 3000,
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
      spaceBetween: 15,
    },

    992: {
      slidesPerView: 3.6,
      spaceBetween: 15,
    },

    1200: {
      slidesPerView: 4.5,
      spaceBetween: 15,
    },
  },
});

// Lấy phần tử blogs
const blogsSection = document.querySelector('.blogs');

// Kiểm tra xem phần tử đã xuất hiện trong viewport chưa
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Xử lý sự kiện cuộn trang
function handleScroll() {
    if (isInViewport(blogsSection)) {
        // Nếu phần tử blogs hiển thị trong viewport
        // Thêm lớp 'animate' vào phần nội dung để chạy animation
        const content = blogsSection.querySelector('.content');
        content.classList.add('animate');
    } else {
        // Nếu phần tử blogs không hiển thị trong viewport
        // Loại bỏ lớp 'animate' khỏi phần nội dung
        const content = blogsSection.querySelector('.content');
        content.classList.remove('animate');
    }
}

// Lắng nghe sự kiện cuộn trang
window.addEventListener('scroll', handleScroll);

