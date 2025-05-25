<?php
return [
    [
        'title' => 'Trang quản trị',
        'route' => 'home',
        'icon' => 'ni ni-tv-2 text-primary',
        'permission' => 'dashboard',
    ],

    [
        'title' => 'Chức năng',
        'is_parent' => true,
        'children' => [
            [
                'title' => 'Nhân viên',
                'route' => 'show-staff.index',
                'icon' => 'ni ni-circle-08 text-dark',
                'permission' => 'user.view',
            ],
            [
                'title' => 'Khách hàng',
                'route' => 'show-customer.index',
                'icon' => '	ni ni-user-run text-dark',
                'permission' => 'customer.view',
            ],

            [
                'title' => 'Loại sản phẩm',
                'route' => 'show-category.index',
                'icon' => 'ni ni-app text-dark',
                'permission' => 'category.view',
            ],
            [
                'title' => 'Nhà cung cấp',
                'route' => 'show-supplier.index',
                'icon' => 'fas fa-handshake text-dark',
//                'permission' => 'supplier.view',
            ],
            [
                'title' => 'Sản phẩm',
                'route' => 'show-product.index',
                'icon' => 'ni ni-basket text-dark',
                'permission' => 'product.view',
            ],

            [
                'title' => 'Đơn hàng',
                'route' => 'show-order.index',
                'icon' => 'ni ni-cart text-dark',
                'permission' => 'order.view',
            ],
            [
                'title' => 'Thông báo',
                'route' => 'show-notification.index',
                'icon' => 'fas fa-bell text-dark',
                'permission' => 'notification.view',
            ],
            [
                'title' => 'Liên hệ',
                'route' => 'admin.contact.index',
                'icon' => 'fas fa-phone text-dark',
//                'permission' => 'contact.view',
            ],
            [
                'title' => 'Phân quyền',
                'route' => 'show-permission.index',
                'icon' => 'ni ni-lock-circle-open text-dark',
                'permission' => 'permission.view',
            ],
            [
                'title' => 'Khuyến mãi',
                'route' => 'show-sale.index',
                'icon' => 'ni ni-tag text-dark',
                'permission' => 'sale.view',
            ],
        ]
    ],
    [
        'title' => 'Tài khoản',
        'is_parent' => true,
        'children' => [
            [
                'title' => 'Trang cá nhân',
                'route' => 'show-profile.index',
                'icon' => 'ni ni-single-02 text-dark',
                'permission' => 'user.profile',
            ],
            [
                'title' => 'Cài đặt',
                'route' => 'admin.setting.index',
                'icon' => 'ni ni-settings text-dark',
                'permission' => 'user.setting',
            ],
            [
                'title' => 'Đăng xuất',
                'route' => 'logout',
                'icon' => 'ni ni-button-power text-danger',
            ],


//            [
//                'title' => 'Thanh toán',
//                'route' => 'vnpay.payment.product',
//                'icon' => 'ni ni-credit-card text-dark',
//            ],
//            [
//                'title' => 'Khách hàng',
//                'route' => 'show-customer.index',
//                'icon' => 'ni ni-bullet-list-67 text-dark',
//            ],
//            [
//                'title' => 'Sản phẩm',
//                'route' => 'show-product.index',
//                'icon' => 'ni ni-basket text-dark',
//            ],

        ]
    ],

];
