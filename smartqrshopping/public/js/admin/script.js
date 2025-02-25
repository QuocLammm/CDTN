function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");
}

document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".sidebar ul li a");

    const currentPage = window.location.pathname;

    menuItems.forEach(item => {
        // Sử dụng substring để so sánh đường dẫn tương đối
        const linkPath = new URL(item.href).pathname;

        if (currentPage === linkPath) {
            item.parentElement.classList.add("active"); // Đánh dấu mục hiện tại
        } else {
            item.parentElement.classList.remove("active"); // Loại bỏ dấu hiệu ở các mục khác
        }
    });
});

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");
}

document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".sidebar ul li a");

    const currentPage = window.location.pathname;

    menuItems.forEach(item => {
        // Sử dụng substring để so sánh đường dẫn tương đối
        const linkPath = new URL(item.href).pathname;

        item.addEventListener("click", function () {
            // Hiển thị overlay và loading spinner khi nhấn vào mục menu
            document.getElementById("overlay").style.display = "block";
            document.getElementById("loading-spinner").style.display = "block";
        });

        if (currentPage === linkPath) {
            item.parentElement.classList.add("active"); // Đánh dấu mục hiện tại
        } else {
            item.parentElement.classList.remove("active"); // Loại bỏ dấu hiệu ở các mục khác
        }
    });
});

// Ẩn overlay và loading spinner khi tài liệu đã được tải xong
window.addEventListener("load", function () {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("loading-spinner").style.display = "none";
});

