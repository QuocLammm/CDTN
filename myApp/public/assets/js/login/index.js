const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');
const darkMode = document.querySelector('.dark-mode');

// Kiểm tra localStorage để thiết lập chế độ
if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.add('active');
}

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

darkMode.addEventListener('click', () => {
    const isDarkModeEnabled = document.body.classList.toggle('dark-mode-variables'); // Lấy trạng thái hiện tại
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');

    // Lưu trạng thái vào localStorage
    if (isDarkModeEnabled) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.removeItem('darkMode');
    }
});

// Giả sử Orders là một mảng đã được định nghĩa
// const tbody = document.querySelector('table tbody');
// if (tbody) {
//     Orders.forEach(order => {
//         const tr = document.createElement('tr');
//         const trContent = `
//             <td>${order.productName}</td>
//             <td>${order.productNumber}</td>
//             <td>${order.paymentStatus}</td>
//             <td class="${order.status === 'Declined' ? 'danger'
//             : order.status === 'Pending' ? 'warning' : 'primary'}">${order.status}</td>
//             <td class="primary">Details</td>
//         `;
//         tr.innerHTML = trContent;
//         tbody.appendChild(tr);
//     });
// } else {
//     console.error('Không tìm thấy tbody trong table.');
// }

//loading
// Hiển thị overlay khi click vào sidebar links
document.querySelectorAll('aside .sidebar a').forEach(link => {
    link.addEventListener('click', (event) => {
        // Hiện overlay loading
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
});

// Hiển thị overlay khi chuyển trang
window.addEventListener('beforeunload', () => {
    document.getElementById('loadingOverlay').style.display = 'flex';
});
