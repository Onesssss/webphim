@extends('layouts.app')

@section('content')
<style type="text/css">
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Định dạng tiêu đề card */
.card-header {
    background-color: #3490dc;
    color: #ffffff;
    font-weight: bold;
}


/* Định dạng hình ảnh khi người dùng đã đăng nhập */
.card-body img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

/* Định dạng form đăng nhập */
.card-body form {
    margin-top: 20px;
}

/* Định dạng button đăng nhập */
.btn-primary {
    background-color: #3490dc;
    border-color: #3490dc;
}

.btn-primary:hover {
    background-color: #2779bd;
    border-color: #2779bd;
}

/* Định dạng link quên mật khẩu */
.btn-link {
    color: #3490dc;
}

.btn-link:hover {
    text-decoration: underline;   
}
body {
    background-image: url('https://img4.thuthuatphanmem.vn/uploads/2019/12/09/phong-nen-powerpoint-phim-truyen_041236386.jpg');
    background-size: 100%; /* Đảm bảo hình ảnh nền được hiển thị đầy đủ màn hình */
    background-position: center; /* Căn giữa hình ảnh nền */
    background-repeat: no-repeat; /* Không lặp lại hình ảnh nền */
    background-attachment: fixed; /* Giữ hình ảnh nền tĩnh khi cuộn trang */
}

.container {
    background-color: rgba(255, 255, 255, 0.8); /* Tạo một lớp mờ trắng để làm cho văn bản dễ đọc hơn */
    border-radius: 10px; /* Bo tròn góc của container */
    padding: 20px; /* Thêm một số lề vào container */
}

.card {
    background-color: rgba(255, 255, 255, 0.9); /* Tạo một lớp mờ trắng cho card */
    border-radius: 15px; /* Bo tròn góc của card */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}






</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
