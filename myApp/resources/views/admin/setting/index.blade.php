@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.header', ['title' => 'Cài đặt'])

    <div class="setting-container" >
        <div >
            <ul id="setting-groups" style="list-style: none">
                <li class="group-item active" data-group="general" style="cursor: pointer; padding: 10px;">⚙️ Cài đặt chung</li>
                <li class="group-item" data-group="email" style="cursor: pointer; padding: 10px;">📧 Email</li>
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

                    <div>
                        <label>Ngôn ngữ</label><br>
                        <select name="settings[site_language]" style="width: 100%; padding: 8px;">
                            <option value="vi" {{ ($generalSettings->firstWhere('key', 'site_language')->value ?? '') == 'vi' ? 'selected' : '' }}>Vietnamese</option>
                            <option value="en" {{ ($generalSettings->firstWhere('key', 'site_language')->value ?? '') == 'en' ? 'selected' : '' }}>English</option>
                        </select>
                    </div>
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
                                value="{{ $emailSettings->firstWhere('key', $key)->value ?? '' }}"
                                style="width: 100%; padding: 8px;"
                            >
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
@endpush
