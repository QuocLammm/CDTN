@php
    use App\Helpers\PermissionHelper;

    $menus = config('menu');
    $userPermissions = PermissionHelper::getUserPermissions();
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <span class="ms-1 font-weight-bold">TRUCDOAN<span style="color: red">PHAM</span></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
{{--    class="collapse navbar-collapse w-auto"--}}
    <div id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach ($menus as $menu)
                @php
                    if (isset($menu['permission']) && !$userPermissions->contains($menu['permission'])) {
                        continue;
                    }
                @endphp

                @if (isset($menu['is_parent']) && $menu['is_parent'] == true)
                    <li class="nav-item mt-3">
                        <div class="d-flex align-items-center ps-4">
                            <i class="fab fa-laravel" style="color: #f4645f;"></i>
                            <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">{{ $menu['title'] }}</h6>
                        </div>
                        <ul class="navbar-nav">
                            @foreach ($menu['children'] as $child)
                                @php
                                    if (isset($child['permission']) && !$userPermissions->contains($child['permission'])) {
                                        continue;
                                    }
                                @endphp
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName() == $child['route'] ? 'active' : '' }}"
                                       href="{{ route($child['route']) }}">
                                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                            <i class="{{ $child['icon'] }} text-sm opacity-10"></i>
                                        </div>
                                        <span class="nav-link-text ms-1">
                                            {{ $child['title'] }}
                                            @if ($child['route'] === 'admin.contact.index')
                                                <span id="unread-contact-count" class="badge bg-danger ms-2" style="display: none;"></span>
                                            @elseif($child['route'] === 'admin.notification.index')
                                                <span class="unread-notification-count badge bg-danger ms-2" style="display: none; border: 1px solid black;"></span>

                                            @endif
                                        </span>

                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == $menu['route'] ? 'active' : '' }}"
                           href="{{ route($menu['route']) }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="{{ $menu['icon'] }} text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $menu['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>
