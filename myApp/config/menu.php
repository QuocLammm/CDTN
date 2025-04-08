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
                'route' => 'show-profile',
                'icon' => 'ni ni-circle-08 text-dark',
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
        ]
    ],
    [
        'title' => 'Tài khoản',
        'is_parent' => true,
        'children' => [
            [
                'title' => 'Nhân viên',
                'route' => 'show-profile',
                'icon' => 'ni ni-circle-08 text-dark',
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
                'icon' => 'ni ni-credit-card text-primary',
            ],
        ]
    ],
//    [
//        'title' => 'Thanh Toán',
//        'route' => 'vnpay.payment.product',
//        'icon' => 'ni ni-credit-card text-primary',
//    ],
];
