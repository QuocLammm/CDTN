let currentIndex = 0;
const slides = document.querySelector('.slides');
const totalSlides = slides.children.length;

// Chuyển đổi ảnh khi nhấn nút
document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlidePosition();
});

document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSlidePosition();
});

// Chuyển đổi ảnh tự động mỗi 5 giây
setInterval(() => {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlidePosition();
}, 5000); // 5000 milliseconds = 5 giây

function updateSlidePosition() {
    const offset = -currentIndex * 100; // Di chuyển theo 100% cho mỗi slide
    slides.style.transform = `translateX(${offset}vw)`;
}
// Scroll
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (window.scrollY > 0) {
        nav.classList.add('scrolled'); // Add class when scrolled down
    } else {
        nav.classList.remove('scrolled'); // Remove class when at the top
    }
});
