@extends('layout')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@endpush

<style>
    .top-sell-section {
        padding: 40px 0 10px;
    }

    .top-sell-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .top-sell-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }

    .sell-card {
        position: relative;
        background: #fff;
        border-radius: 12px;
        padding: 18px;
        border: 1px solid #eee;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: 0.25s;
    }

    .sell-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .wishlist-btn {
        position: absolute;
        top: 10px;
        left: 10px;
        border: none;
        background: transparent;
        font-size: 20px;
        cursor: pointer;
    }

    .sell-img img {
        width: 100%;
        height: 180px;
        object-fit: contain;
    }

    .sell-name {
        font-size: 16px;
        font-weight: 700;
        margin: 10px 0;
        color: #222;
    }

    .sell-price-box {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sell-new {
        color: #e60000;
        font-size: 18px;
        font-weight: 700;
    }

    .sell-old {
        color: #999;
        text-decoration: line-through;
    }

    .sell-percent {
        background: #ff4d4f;
        color: #fff;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 6px;
    }

    .sell-bonus {
        margin-top: 12px;
    }

    .bonus-line {
        font-size: 14px;
        margin-top: 4px;
        color: #444;
    }

    .bonus-line i {
        color: #ff4d4f;
        margin-right: 6px;
    }

    .add-cart-btn {
        position: absolute;
        right: 18px;
        bottom: 18px;
        background: #ff4d4f;
        color: #fff;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: .2s;
    }

    .add-cart-btn:hover {
        background: #d63031;
    }

    .view-more-container {
        margin-top: 18px;
        text-align: center;
    }

    .view-more-btn {
        font-size: 16px;
        font-weight: 600;
        color: #34A4E0;
        text-decoration: none;
    }

    .view-more-btn:hover {
        text-decoration: underline;
    }

    .top-sell-title {
    font-size: 28px;
    font-weight: 700;
    animation: flashColor 1s infinite alternate;
}

/* Hiệu ứng đổi màu đỏ ↔ vàng */
@keyframes flashColor {
    0% {
        color: #ff0000; /* đỏ */
        text-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
    }
    100% {
        color: #ffd700; /* vàng */
        text-shadow: 0 0 12px rgba(255, 215, 0, 0.8);
    }
}
.sale-banner {
    width: 100%;
    margin: 40px 0;
    display: flex;
    justify-content: center;
}

.sale-banner-inner {
    width: 100%;
    max-width: 1400px; /* Cho banner không quá to trên màn lớn */
    overflow: hidden;
    border-radius: 14px;
}

.sale-banner-img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 14px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

/* Hiệu ứng hover nhẹ */
.sale-banner-img:hover {
    transform: scale(1.02);
}


</style>
<!-- HERO BANNER -->
<section class="hero-banner">

    <video autoplay muted loop playsinline" class="banner-video">
      <source src="https://res.cloudinary.com/dyk9mzb5t/video/upload/v1763131649/1114_xiw66b.mp4" type="video/mp4">
    </video>
     <!-- Lớp phủ tối -->
  <div class="overlay"></div>
    <div class="banner-content highlighted dynamic-overlay">
            <h1>Chào mừng đến với Rise Fitness & Yoga</h1>
            <p class="slogan">Chinh phục vóc dáng, bứt phá giới hạn!</p>
            <div class="banner-buttons">
                <a href="#trial-signup" class="cta-button highlighted rect-button animated" style="color: #fff;">Đăng ký tập thử</a>
                <a href="#products" class="cta-button highlighted rect-button animated" style="color: #fff;">Xem Dịch Vụ</a>
            </div>
        </div>
    </div>
    <div class="marquee-container">
            <div class="marquee">
                <a href="pages/gym.html">Gym</a>  <a href="pages/swimming.html">Swimming</a>  <a href="pages/kickboxing.html">Kick Boxing</a>  <a href="pages/dance.html">Dance</a>  <a href="pages/yoga.html">Yoga</a>
                <a href="pages/gym.html">Gym</a>  <a href="pages/swimming.html">Swimming</a>  <a href="pages/kickboxing.html">Kick Boxing</a>  <a href="pages/dance.html">Dance</a>  <a href="pages/yoga.html">Yoga</a>
                <a href="pages/gym.html">Gym</a>  <a href="pages/swimming.html">Swimming</a>  <a href="pages/kickboxing.html">Kick Boxing</a>  <a href="pages/dance.html">Dance</a>  <a href="pages/yoga.html">Yoga</a>
                <a href="pages/gym.html">Gym</a>  <a href="pages/swimming.html">Swimming</a>  <a href="pages/kickboxing.html">Kick Boxing</a>  <a href="pages/dance.html">Dance</a>  <a href="pages/yoga.html">Yoga</a>
            </div>
        </div>
    </div>
    </header>
</section>
<!-- About - về chúng tôi -->
<section id="about">
        <div class="about-container">
        <div class="about-image slideshow">
            <img src="/frontend/img/gym-equipment.jpg" alt="Gym 1"class="slide active">
            <img src="/frontend/img/gym-equipment2.jpg" alt="Gym 2" class="slide">
            <img src="/frontend/img/gym-equipment3.jpg" alt="Gym 3" class="slide">
            <img src="/frontend/img/gym-equipment4.jpg" alt="Gym 4" class="slide">
            <img src="/frontend/img/gym-equipment5.jpg" alt="Gym 5" class="slide">
        </div>
        <div class="about-content">
            <h2>Về Chúng Tôi</h2>
            <p>Chào mừng bạn đến với phòng tập hiện đại nhất trong thành phố! Chúng tôi tự hào mang đến không gian tập luyện được trang bị máy móc hiện đại, đội ngũ huấn luyện viên chuyên nghiệp, cùng các lớp học đa dạng. Hãy đến và trải nghiệm không gian tập luyện đẳng cấp, nơi bạn có thể cải thiện sức khỏe và nâng cao chất lượng cuộc sống!</p>
            <div class="about-details">
                <div class="schedule">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <p>Thứ 2 - Thứ 6: 6:00 - 23:00</p>
                    <p>Thứ 7: 6:00 - 22:00</p>
                    <p>Chủ nhật: 6:00 - 20:00</p>
                </div>
                <div class="location">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <p>12 Phố Chùa Bộc, Quang Trung, Đống Đa, Hà Nội</p>
                </div>
            </div>
            <div class="about-buttons">
                <a href="#trial-signup" class="cta-button highlighted">Đăng ký ngay</a>
                <a href="pages/about.html" class="cta-button">Xem thêm</a>
            </div>
        </div>
    </div>
</section>

<img src="/frontend/img/sale-40-banner.webp" alt="Sale 40%" class="sale-banner-img">


<section class="top-sell-section">
    <div class="container">
        <h2 class="top-sell-title">Top sản phẩm bán chạy!</h2>

        <div class="top-sell-grid">
            @foreach($featured as $sp)
            <div class="sell-card">

                <!-- Icon trái tim -->
                <button class="wishlist-btn">
                    <i class="fa-regular fa-heart"></i>
                </button>

                <a href="{{ route('detail', $sp->id_sanpham) }}" class="product-link">

                    <!-- Ảnh -->
                    <div class="sell-img">
                        <img src="{{ asset($sp->anhsp) }}" alt="{{ $sp->tensp }}">
                    </div>

                    <!-- Tên -->
                    <h3 class="sell-name">{{ $sp->tensp }}</h3>

                    <!-- Giá -->
                    <div class="sell-price-box">
                        <span class="sell-new">{{ number_format($sp->giakhuyenmai) }}đ</span>

                        @if($sp->giamgia)
                        <span class="sell-old">{{ number_format($sp->giasp) }}đ</span>
                        <span class="sell-percent">-{{ $sp->giamgia }}%</span>
                        @endif
                    </div>

                    <!-- Hàng dưới: Ưu đãi -->
                    <div class="sell-bonus">
                        <div class="bonus-line">
                            <i class="fa-solid fa-gift"></i> Giá tốt nhất thị trường
                        </div>
                        <div class="bonus-line">
                            <i class="fa-solid fa-gift"></i> Quà tặng trị giá {{ rand(100,200) }}.000đ
                        </div>
                    </div>

                </a>

                <!-- Nút giỏ hàng -->
                <a href="{{ route('add_to_cart', $sp->id_sanpham) }}"
                   class="add-cart-btn js-add-to-cart" data-url="{{ route('add_to_cart', $sp->id_sanpham) }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

            </div>
            @endforeach
        </div>

        <div class="view-more-container">
            <a href="/viewAll" class="view-more-btn">Xem tất cả →</a>
        </div>
    </div>
</section>
<section class="brand-section" id="brands">
    <div class="container">

        <div class="brand-tabs">

            <button class="brand-tab active">
                <i class="fa-solid fa-border-all"></i>
                Tất cả sản phẩm
            </button>

            <button class="brand-tab">
                <i class="fa-solid fa-dumbbell"></i>
                Dụng cụ tập luyện
            </button>

            <button class="brand-tab">
                <i class="fa-solid fa-flask-vial"></i>
                Whey & Dinh dưỡng
            </button>

            <button class="brand-tab">
                <i class="fa-solid fa-shirt"></i>
                Đồ tập
            </button>

            <button class="brand-tab">
                <i class="fa-solid fa-toolbox"></i>
                Phụ kiện
            </button>

        </div>

    </div>
</section>



<div id="cart-toast" class="cart-toast">
    <span class="cart-toast__text"></span>
</div>
@push('scripts')
<script src="{{ asset('frontend/script/about.js') }}"></script>
@endpush
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.js-add-to-cart');
    const toast = document.getElementById('cart-toast');
    const toastText = toast.querySelector('.cart-toast__text');
    let toastTimeout;

    buttons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault(); 

            const url = this.dataset.url;
            if (!url) return;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json().catch(() => ({})))
            .then(data => {
                const msg = data.message || 'Đã thêm sản phẩm vào giỏ hàng';
                showCartToast(msg);
            })
            .catch(() => {
                showCartToast('Có lỗi xảy ra, vui lòng thử lại!');
            });
        });
    });

    function showCartToast(message) {
        toastText.textContent = message;
        toast.classList.add('show');

        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 2000); // hiện 2s rồi tự ẩn
    }
});
</script>


@endsection


