window.addEventListener("scroll", function () {
    var nav = document.querySelector("nav");
    if (window.scrollY > 0) {
        nav.classList.add("sticky-nav");
    } else {
        nav.classList.remove("sticky-nav");
    }
});

// scroll -slide
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slide");
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? "block" : "none";
        });
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    }

    function prevSlide() {
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlide(slideIndex);
    }

    // Auto chuyển động mỗi 5 giây
    let autoSlide = setInterval(nextSlide, 5000);

    // Gán sự kiện click cho nút
    nextBtn.addEventListener("click", () => {
        nextSlide();
        resetAutoSlide();
    });

    prevBtn.addEventListener("click", () => {
        prevSlide();
        resetAutoSlide();
    });

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextSlide, 5000);
    }

    // Hiển thị slide đầu tiên khi load trang
    showSlide(slideIndex);

// Thông báo
document.getElementById('notification-icon').addEventListener('click', function(e) {
    e.preventDefault();
    var dropdown = document.getElementById('notification-dropdown');

    // Kiểm tra nếu dropdown đang hiển thị, thì ẩn nó, ngược lại hiển thị
    dropdown.classList.toggle('show');
});

// Đóng dropdown khi nhấn ở ngoài
window.addEventListener('click', function(e) {
    if (!e.target.closest('.icon') && !e.target.closest('.notification-dropdown')) {
        document.getElementById('notification-dropdown').classList.remove('show');
    }
});


// Iteam Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        window.scrollTo({
            top: targetElement.offsetTop - document.querySelector('nav').offsetHeight,
            behavior: 'smooth'
        });
    });
});




