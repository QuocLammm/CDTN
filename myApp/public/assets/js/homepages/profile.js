
document.addEventListener('DOMContentLoaded', function () {
    const logoLink = document.getElementById('logo-link');
    const logoText = document.getElementById('logo-text');

        logoLink.addEventListener('mouseenter', function () {
        logoText.style.width = '200px'; // Mở rộng khi hover vào logo
    });

        logoLink.addEventListener('mouseleave', function () {
        logoText.style.width = '0'; // Thu lại khi bỏ hover
    });
});

