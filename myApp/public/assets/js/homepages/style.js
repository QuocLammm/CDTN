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


