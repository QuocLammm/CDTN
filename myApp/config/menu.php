<?php
return [
    [
        'title' => 'Trang quản trị',
        'route' => 'home',
        'icon' => 'ni ni-tv-2 text-primary',
    ],
    [
        'title' => 'Chức năng',
        'is_parent' => true,
        'children' => [
            [
                'title' => 'Nhân viên',
                'route' => 'show-staff.index',
                'icon' => 'ni ni-circle-08 text-dark',
            ],
            [
                'title' => 'Khách hàng',
                'route' => 'show-customer.index',
                'icon' => '	ni ni-single-copy-04 text-dark',
            ],
            [
                'title' => 'Sản phẩm',
                'route' => 'show-product.index',
                'icon' => 'ni ni-basket text-dark',
            ],
            [
                'title' => 'Loại sản phẩm',
                'route' => 'show-category.index',
                'icon' => 'ni ni-app text-dark',
            ],
            [
                'title' => 'Đơn hàng',
                'route' => 'show-order.index',
                'icon' => 'ni ni-cart text-dark',
            ],
            [
                'title' => 'Khuyến mãi',
                'route' => 'show-sale.index',
                'icon' => 'ni ni-tag text-dark',
            ],
        ]
    ],
    [
        'title' => 'Tài khoản',
        'is_parent' => true,
        'children' => [
            [
                'title' => 'Trang cá nhân',
                'route' => 'show-profile',
                'icon' => 'ni ni-circle-08 text-dark',
            ],
            [
                'title' => 'Cài đặt',
                'route' => 'vnpay.payment.product',
                'icon' => 'fa fa-cog text-dark',
            ],
            [
                'title' => 'Khách hàng',
                'route' => 'show-customer.index',
                'icon' => 'ni ni-bullet-list-67 text-dark',
            ],
            [
                'title' => 'Sản phẩm',
                'route' => 'show-product.index',
                'icon' => 'ni ni-basket text-dark',
            ],
            [
                'title' => 'Thanh toán',
                'route' => 'vnpay.payment.product',
                'icon' => 'ni ni-credit-card text-dark',
            ],
        ]
    ],
//    [
//        'title' => 'Thanh Toán',
//        'route' => 'vnpay.payment.product',
//        'icon' => 'ni ni-credit-card text-primary',
//    ],
];
