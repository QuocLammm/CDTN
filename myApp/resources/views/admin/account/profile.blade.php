@extends('layouts.app')
@push('css')
    <style>
        .gender-male {
            color: #00bcd4;
        }
        .gender-female {
            color: red;
        }
    </style>
@endpush
@section('content')
    @include('layouts.header', ['title' => 'Trang cá nhân'])
    <div class="card shadow-lg mx-4 ">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar position-relative">
                        <img src="{{ auth()->user()->image }}" alt="profile_image"
                             class="border-radius-lg shadow-sm"
                             style="width: 60px; height: 60px; object-fit: cover;">
                    </div>

                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->full_name ?? 'Tên người dùng' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error-->
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" action="{{ route('show-profile.update', auth()->user()->user_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Thông tin người dùng -->
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h2 class="text-uppercase text-sm">Thông tin người dùng</h2>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Họ và tên</label>
                                        <input class="form-control" type="text" name="username" value="{{ old('username', auth()->user()->full_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth" class="form-control-label">Ngày sinh</label>
                                        <input class="form-control" type="date" name="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth ? \Carbon\Carbon::parse(auth()->user()->date_of_birth)->format('Y-m-d') : '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Tỉnh/Thành phố</label>
                                        <select id="province" class="form-control">
                                            <option value="">-- Chọn Tỉnh/Thành phố --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Huyện</label>
                                        <select id="district" class="form-control">
                                            <option value="">-- Chọn Huyện --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Địa chỉ cụ thể</label>
                                        <input class="form-control" type="text" id="detail_address" placeholder="Số nhà, tên đường..." value="{{ old('address', auth()->user()->address) }}">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="address" id="full_address">
                        </div>
                    </form>
                </div>

                <div class="card mt-3">
                    <form method="POST" action="{{ route('show-profile.update', auth()->user()->user_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Thông tin liên hệ -->
                        <div class="card-header pb-0">
                            <h2 class="text-uppercase text-sm">Thông tin liên hệ</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">Số điện thoại</label>
                                        <input class="form-control" type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-profile shadow-lg border-0">
                    <div class="card-header p-0 position-relative">
                        <img src="{{ asset('/img/bg-profile.jpg') }}" alt="background" class="w-100" style="height: 150px; object-fit: cover;">
                        <div class="position-absolute top-100 start-50 translate-middle">
                            <img src="{{ auth()->user()->image}}" alt="avatar" class="rounded-circle border border-white shadow-sm" width="100" height="100">
                        </div>
                    </div>
                    <div class="card-body text-center mt-5 pt-4">
                        <h5 class="font-weight-bold mb-1">{{ auth()->user()->full_name ?? 'Tên người dùng' }}</h5>
                        <p class="text-muted mb-2">{{ auth()->user()->email ?? 'example@example.com' }}</p>
                        <hr>
                        <div class="text-start px-3">
                            <div class="row mb-2">
                                <div class="col-8">
                                    <strong>Ngày sinh:</strong> {{ auth()->user()->date_of_birth ? \Carbon\Carbon::parse(auth()->user()->date_of_birth)->format('d/m/Y') : 'Chưa cập nhật' }}
                                </div>
                                <div class="col-4">
                                    <strong>Tuổi:</strong>
                                    @if (auth()->user()->date_of_birth)
                                        {{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse(auth()->user()->date_of_birth)->year }}
                                    @else
                                        Chưa cập nhật
                                    @endif
                                </div>
                            </div>
                            <div class="mb-2">
                                <strong>Giới tính:</strong>
                                @if (auth()->user()->gender === 1)
                                    <span class="gender-male">Nam</span> <span class="material-symbols-outlined gender-male">male</span>
                                @elseif (auth()->user()->gender === 0)
                                    <span class="material-symbols-outlined gender-female">female</span> Nữ
                                @else
                                    Chưa cập nhật
                                @endif
                            </div>
                            <div class="mb-2">
                                <strong>Số điện thoại:</strong> {{ auth()->user()->phone ?? 'Chưa cập nhật' }}
                            </div>
                            <div class="mb-2">
                                <strong>Địa chỉ:</strong> {{ auth()->user()->address ?? 'Chưa cập nhật' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let provinces = {};
        let districts = {};

        // Load provinces
        fetch('/provinces.json')
            .then(res => {
                if (!res.ok) {
                    throw new Error('Failed to load provinces data');
                }
                return res.json();
            })
            .then(data => {
                provinces = Object.values(data);
                const provinceSelect = document.getElementById('province');
                provinces.forEach(p => {
                    let opt = document.createElement('option');
                    opt.value = p.code; // Lưu mã tỉnh
                    opt.text = p.name;
                    provinceSelect.appendChild(opt);
                });
            })
            .catch(error => {
                console.error('Error loading provinces:', error);
            });

        // Load districts
        fetch('/districts.json')
            .then(res => res.json())
            .then(data => {
                districts = Object.values(data);
            })
            .catch(error => {
                console.error('Error loading districts:', error);
            });

        // When province changes, update the district list
        document.getElementById('province').addEventListener('change', function () {
            const selectedProvince = this.value;
            const districtSelect = document.getElementById('district');
            districtSelect.innerHTML = '<option value="">-- Chọn Huyện --</option>';

            let filtered = districts.filter(d => d.parent_code === selectedProvince);
            filtered.forEach(d => {
                let opt = document.createElement('option');
                opt.value = d.name;
                opt.text = d.name;
                districtSelect.appendChild(opt);
            });

            updateFullAddress();
        });

        // Update hidden input when address fields change
        ['district', 'detail_address'].forEach(id => {
            document.getElementById(id).addEventListener('input', updateFullAddress);
        });

        function updateFullAddress() {
            const province = document.getElementById('province').value;
            const district = document.getElementById('district').value;
            const detail = document.getElementById('detail_address').value;

            let result = detail;
            if (district) result += `, ${district}`;
            if (province) result += `, ${province}`;

            document.getElementById('full_address').value = result;
        }
    </script>
@endpush
