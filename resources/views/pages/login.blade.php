@extends('layout')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
@endpush
@if (session('needLogin'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Thông báo',
        text: 'Bạn cần đăng nhập để tiếp tục.',
        confirmButtonText: 'Đồng ý',
        customClass: {
            confirmButton: 'swal-button'
        }
    });
</script>
@endif


<div class="login-wrapper">
    <!-- Animated Background -->
    <div class="background-animation">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Left Panel -->
    <div class="left-panel">
        <div class="welcome-content">
            <h1 style="
    font-size: 48px;
    font-weight: 800;
    color: #80c8f0ff;
    text-shadow:
        0 0 5px #3b82f6,
        0 0 10px #3b82f6,
        0 0 20px #3b82f6,
        0 0 40px #3b82f6;
">
    BỨT PHÁ GIỚI HẠNNN
</h1>

            <h1>TẠO RA PHIÊN BẢN TỐT NHẤT CỦA BẠN!</h1>
            
            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">🔎</div>
                    <div>
                        <strong>Tìm gì cũng có – Mua gì cũng nhanh</strong><br>
                        <small>Đăng nhập để xem giá tốt hơn, lưu bộ sưu tập yêu thích và theo dõi các mặt hàng đang quan tâm.</small>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🏋️</div>
                    <div>
                        <strong>Năng lượng cho mục tiêu hình thể</strong><br>
                        <small>Nhận các sản phẩm bổ trợ luyện tập giúp bạn nâng cao hiệu quả và đạt mục tiêu hình thể nhanh hơn.</small>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💡</div>
                    <div>
                        <strong>Tiện ích thông minh dành riêng cho bạn</strong><br>
                        <small>Khi đăng nhập, bạn sẽ nhận được gợi ý sản phẩm phù hợp, ưu đãi riêng và thông báo cá nhân hoá</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel - Login Form -->
    <div class="right-panel">
        <div class="login-card">
            <div class="logo-container">
                <div class="logo">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="login-header">
                    <h3>Đăng nhập</h3>
                </div>
            </div>

            <form action="{{route('login')}}" method="POST" class="login-form" id="form-login">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            class="form-control"
                            placeholder="example@email.com"
                            required
                        >
                        <i class="fa-solid fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="password-wrapper">
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="form-control"
                                placeholder="Nhập mật khẩu của bạn"
                                required
                            >
                            <i class="fa-solid fa-lock input-icon"></i>
                            <span class="toggle-password" id="togglePassword">
                                <i class="fa-solid fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                    <a href="{{ route('password.forgot') }}" style="color: #6366f1; text-decoration: none; font-weight: 600;">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="form-submit" id="submitBtn">
                    <span>Đăng nhập ngay</span>
                </button>

                <div class="divider">
                    <span>Hoặc đăng nhập với</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-btn">
                        <i class="fa-brands fa-google" style="color: #DB4437;"></i>
                        Google
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fa-brands fa-facebook" style="color: #1877F2;"></i>
                        Facebook
                    </button>
                </div>

                <div class="auth-links">
                    <div class="auth-link">
                        Chưa có tài khoản? <a href="{{ URL::to('register')}}">Đăng ký miễn phí</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Đăng nhập thất bại',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false,
        background: '#fff',
        customClass: {
            popup: 'animated-popup'
        }
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
        background: '#fff',
        customClass: {
            popup: 'animated-popup'
        }
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        }

        // Form submit loading animation
        const form = document.getElementById('form-login');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<span>Đang xử lý...</span>';
        });

        // Input focus animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Prevent social login buttons from submitting form
        const socialBtns = document.querySelectorAll('.social-btn');
        socialBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Add your social login logic here
                console.log('Social login clicked');
            });
        });
    });
</script>

@endsection