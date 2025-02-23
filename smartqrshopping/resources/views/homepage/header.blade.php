<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Header</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .navbar {
            background-color: #343a40; /* Màu nền header */
        }
        .navbar-brand img {
            height: 50px; /* Kích thước logo */
        }
        .nav-item a {
            color: white !important;
            font-weight: 500;
        }
        .nav-item a:hover {
            color: #f8d210 !important;
        }
        .icon-link {
            color: white;
            font-size: 20px;
            margin-left: 15px;
        }
        .icon-link:hover {
            color: #f8d210;
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="Logo">
        </a>

        <!-- Menu chính -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="giamgia.php">Giảm giá</a></li>
                <li class="nav-item"><a class="nav-link" href="giaynu.php">Giày nữ</a></li>
                <li class="nav-item"><a class="nav-link" href="thongtin.php">Thông tin cửa hàng</a></li>
                <li class="nav-item"><a class="nav-link" href="phukien.php">Phụ kiện</a></li>
            </ul>

            <!-- Biểu tượng Login, Giỏ hàng, Thông báo -->
            <div class="d-flex align-items-center">
                <a href="login.php" class="icon-link"><i class="fas fa-user"></i></a>
                <a href="cart.php" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
                <a href="notifications.php" class="icon-link"><i class="fas fa-bell"></i></a>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
