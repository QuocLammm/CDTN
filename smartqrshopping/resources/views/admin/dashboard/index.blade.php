<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <div class="loading-overlay" id="loadingOverlay" style="display: none;">
            <div class="infinity-loader">
                <div class="infinity"></div>
            </div>
        </div>
        <!--Nội dung chính ở đây đây-->
        <br>
        <br>
        <h1>Trang Quản Trị</h1>
        <!--Analytics-->
        <div class="analyse">
            <div class="sales">
                <div class="status">
                    <div class="info">
                        <h3>Doanh số hôm nay</h3>
                        <h1>12,000,000 đ</h1>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36">
                            </circle>
                        </svg>
                        <div class="percentage">
                            <p>+81%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="visits">
                <div class="status">
                    <div class="info">
                        <h3>Khách truy cập</h3>
                        <h1>35,000 <span style="color: silver; font-size: 22px;">lượt</span></h1>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36">
                            </circle>
                        </svg>
                        <div class="percentage">
                            <p>-12%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="searches">
                <div class="status">
                    <div class="info">
                        <h3>Tìm kiếm sản phẩm</h3>
                        <h1>72,000 <span style="color: silver; font-size: 22px;">lượt</span></h1>
                    </div>
                    <div class="progresss">
                        <svg>
                            <circle cx="38" cy="38" r="36">
                            </circle>
                        </svg>
                        <div class="percentage">
                            <p>+36%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Analytics-->

        <!--Start new user-->
        <div class="new-users">
            <h2>Nhân viên</h2>
            <div class="user-list">
                <div class="user">
                    <img src="/images/quoclam.jpg" alt="">
                    <h2>Quốc Lâm</h2>
                    <p>5 Min Ago</p>
                </div>
                <div class="user">
                    <img src="/images/1.jpg" alt="">
                    <h2>Hữu Lộc</h2>
                    <p>115 Min Ago</p>
                </div>
                <div class="user">
                    <img src="/images/nf.jpg" alt="">
                    <h2>Quỳnh Như</h2>
                    <p>22 Min Ago</p>
                </div>
                <div class="user">
                    <img src="/images/plus.jpg" alt="">
                    <h2>More</h2>
                    <p>New User</p>
                </div>
            </div>
        </div>
        <!--End of New User-->
        <!--Recen Order-->
        <div class="recent-orders">
            <h2>Đơn hàng gần đây</h2>
            <table>
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <a href="#">Show All</a>
        </div>
        <!--End of Recent-->
    </main>


    @include('layouts.right_section')
</div>

<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>
