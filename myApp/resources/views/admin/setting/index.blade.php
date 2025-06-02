@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@php
    $breadcrumbItems = [
        ['label' => 'Cài đặt', 'url' => route('admin.setting.index')],
        ['label' => 'Cài đặt chung']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="setting-container" >
        <div >
            <ul id="setting-groups" style="list-style: none">
                <li class="group-item active" data-group="general" style="cursor: pointer; padding: 10px;">⚙️ Cài đặt chung</li>
                <li class="group-item" data-group="email" style="cursor: pointer; padding: 10px;">📧 Email</li>
                <li class="group-item" data-group="contact" style="cursor: pointer; padding: 10px;">📞 Liên hệ</li>
{{--                <li class="group-item" data-group="contact" style="cursor: pointer; padding: 10px;">📞 Chân trang/li>--}}
            </ul>
        </div>

        <div style="flex: 1;">
            <div class="group-content" data-group="general" style="display: block;">
                <form action="{{ route('admin.setting.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label>Logo</label><br>
                        @if($generalSettings->firstWhere('key', 'site_logo')->value)
                            <img src="{{ asset($generalSettings->firstWhere('key', 'site_logo')->value) }}" alt="Site Logo" style="max-height: 60px; display: block; margin-bottom: 8px;">
                        @endif
                        <input type="file" name="site_logo" accept="/images/website/*" style="width: 100%; padding: 8px;">
                    </div>

                    <div>
                        <label>Favicon</label><br>
                        @if($generalSettings->firstWhere('key', 'site_favicon')->value)
                            <img src="{{ asset($generalSettings->firstWhere('key', 'site_favicon')->value) }}" alt="Site Favicon" style="max-height: 40px; display: block; margin-bottom: 8px;">
                        @endif
                        <input type="file" name="site_favicon" accept="/images/website/*" style="width: 100%; padding: 8px;">
                    </div>
                    <!-- ReCapcha -->
                    <div style="margin-top: 15px;">
                        <label>reCAPTCHA Site Key</label><br>
                        <input
                            type="text"
                            name="settings[recaptcha_site_key]"
                            value="{{ $generalReCapchaSettings->firstWhere('key', 'recaptcha_site_key')->value ?? '' }}"
                            style="width: 100%; padding: 8px;"
                        >
                    </div>

                    <div style="margin-top: 15px;">
                        <label>reCAPTCHA Secret Key</label><br>
                        <input
                            type="text"
                            name="settings[recaptcha_secret_key]"
                            value="{{ $generalReCapchaSettings->firstWhere('key', 'recaptcha_secret_key')->value ?? '' }}"
                            style="width: 100%; padding: 8px;"
                        >
                    </div>

{{--                    <div>--}}
{{--                        <label>Ngôn ngữ</label><br>--}}
{{--                        <select name="settings[site_language]" style="width: 100%; padding: 8px;">--}}
{{--                            <option value="vi" {{ ($generalSettings->firstWhere('key', 'site_language')->value ?? '') == 'vi' ? 'selected' : '' }}>Vietnamese</option>--}}
{{--                            <option value="en" {{ ($generalSettings->firstWhere('key', 'site_language')->value ?? '') == 'en' ? 'selected' : '' }}>English</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <button type="submit" style="padding: 8px 15px; cursor: pointer;">Lưu Cài Đặt</button>
                </form>
            </div>

                {{-- Email Settings --}}
                <div class="group-content" data-group="email" style="display: none;">
                    <form action="{{ route('admin.setting.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach([
                          'mail_mailer' => 'Mailer',
                          'mail_host' => 'Host',
                          'mail_port' => 'Port',
                          'mail_username' => 'Username',
                          'mail_password' => 'Password',
                          'mail_encryption' => 'Encryption',
                          'mail_from_address' => 'From Address',
                          'mail_from_name' => 'From Name',
                        ] as $key => $label)
                            <div style="margin-bottom: 15px;">
                                <label>{{ $label }}</label><br>
                                <input
                                    type="{{ $key == 'mail_password' ? 'password' : 'text' }}"
                                    name="settings[{{ $key }}]"
                                    value="{{ $emailSettings->firstWhere('key', $key)->value ?? [
                                        'mail_mailer' => 'smtp',
                                        'mail_host' => 'smtp.gmail.com',
                                        'mail_port' => '587',
                                        'mail_encryption' => 'tls',
                                    ][$key] ?? '' }}"
                                    style="width: 100%; padding: 8px;"
                                >
                            </div>
                        @endforeach
                        <button type="submit" style="padding: 8px 15px; cursor: pointer;">Lưu Cài Đặt</button>
                    </form>
                </div>

            {{-- Contact Settings --}}
            <div class="group-content" data-group="contact" style="display: none;">
                <form action="{{ route('admin.setting.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    @foreach([
                        'contact_address' => 'Địa chỉ',
                        'contact_phone' => 'Điện thoại',
                        'contact_email' => 'Email',
                        'contact_opening_hours' => 'Giờ mở cửa',
                        'contact_google_map_iframe' => 'Iframe Bản đồ (HTML)',
                        'contact_description' => 'Mô tả chân trang',
                    ] as $key => $label)
                        <div style="margin-bottom: 15px;">
                            <label>{{ $label }}</label><br>
                            @if($key === 'contact_google_map_iframe')
                                <textarea name="settings[{{ $key }}]" rows="5" style="width: 100%; padding: 8px;">{{ $contactSettings->firstWhere('key', $key)->value ?? '' }}</textarea>
                            @else
                                <input
                                    type="text"
                                    name="settings[{{ $key }}]"
                                    value="{{ $contactSettings->firstWhere('key', $key)->value ?? '' }}"
                                    style="width: 100%; padding: 8px;"
                                >
                            @endif
                        </div>
                    @endforeach
                    <button type="submit" style="padding: 8px 15px; cursor: pointer;">Lưu Cài Đặt</button>
                </form>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        document.querySelectorAll('#setting-groups .group-item').forEach(item => {
            item.addEventListener('click', () => {
                // Remove active class all
                document.querySelectorAll('#setting-groups .group-item').forEach(i => i.classList.remove('active'));
                // Add active to clicked
                item.classList.add('active');

                const group = item.getAttribute('data-group');

                // Show the corresponding group content, hide others
                document.querySelectorAll('.group-content').forEach(content => {
                    if(content.getAttribute('data-group') === group) {
                        content.style.display = 'block';
                    } else {
                        content.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script>
        const breadcrumbItems = document.querySelectorAll('.breadcrumb-item');
        const lastBreadcrumb = breadcrumbItems[breadcrumbItems.length - 1];

        document.querySelectorAll('#setting-groups .group-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('#setting-groups .group-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                const group = item.getAttribute('data-group');

                document.querySelectorAll('.group-content').forEach(content => {
                    content.style.display = content.getAttribute('data-group') === group ? 'block' : 'none';
                });

                // Đổi tên breadcrumb cuối
                if(group === 'general') {
                    lastBreadcrumb.textContent = 'Cài đặt chung';
                } else if(group === 'email') {
                    lastBreadcrumb.textContent = 'Email';
                }else if(group === 'contact'){
                    lastBreadcrumb.textContent = 'Liên hệ';
                }
            });
        });


    </script>
@endpush
