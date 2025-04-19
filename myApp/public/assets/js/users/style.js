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

// logo
document.addEventListener("DOMContentLoaded", function() {
    const text = "TRUCDOANPHAM";
    const logoText = document.getElementById("logo-text");
    let index = 0;

    // Hiện thẻ p
    logoText.style.display = "block";

    function showNextCharacter() {
        if (index < text.length) {
            logoText.innerHTML += text.charAt(index); // Thêm ký tự vào thẻ p
            index++;
            setTimeout(showNextCharacter, 100); // Hiển thị ký tự tiếp theo
        } else {
            setTimeout(removeLastCharacter, 2000); // Bắt đầu xóa sau 2 giây
        }
    }

    function removeLastCharacter() {
        if (index > 0) {
            index--;
            logoText.innerHTML = text.slice(0, index); // Xóa ký tự cuối cùng
            setTimeout(removeLastCharacter, 100); // Xóa ký tự tiếp theo
        } else {
            // Reset lại sau khi xóa xong
            setTimeout(() => {
                logoText.innerHTML = ""; // Xóa nội dung
                index = 0; // Đặt lại chỉ số
                setTimeout(showNextCharacter, 2000); // Chờ 2 giây trước khi chạy lại
            }, 2000); // Chờ 2 giây trước khi xóa
        }
    }

    setTimeout(showNextCharacter, 3000); // Bắt đầu sau 3 giây
});

// Giả sử bạn đã có thông tin khách hàng từ server
const user = {
    avatar: "/images/nf.jpg" // Đường dẫn đến ảnh đại diện
};

// Cập nhật avatar
document.getElementById("user-avatar").src = user.avatar;
