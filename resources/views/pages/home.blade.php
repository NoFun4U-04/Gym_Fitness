@extends('layout')
@section('content')
<style>
    /* ===== RESET & GENERAL ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container-fluid {
        padding: 0;
    }

    /* ===== HERO BANNER ===== */
/* Nút hình chữ nhật dài với viền trắng và hiệu ứng phát sáng */
.cta-button.rect-button {
    border: 2px solid #fff;
    border-radius: 0;
    padding: 10px 50px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
}

.cta-button.rect-button::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 0;
    transition: opacity 0.3s ease;
    opacity: 0;
    z-index: -1;
}

.cta-button.rect-button:hover::after {
    opacity: 1;
}

.cta-button.highlighted {
    background: #34A4E0;
    box-shadow: 0 4px 15px rgba(52, 164, 224, 0.6);
}

.cta-button.highlighted:hover {
    background: linear-gradient(90deg, #34A4E0, #58c2fc);
    box-shadow: 0 6px 20px rgba(52, 164, 224, 0.8);
}

.hero-banner {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    z-index: 1; /* Đảm bảo header có z-index thấp hơn modal */
}

.banner-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

/* Lớp phủ động cho video */
.hero-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
    animation: fadeOverlay 4s infinite alternate;
}

@keyframes fadeOverlay {
    0% {
        opacity: 0.3;
    }
    50% {
        opacity: 0.5;
    }
    100% {
        opacity: 0.3;
    }
}

.banner-content {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 2;
    color: white;
    opacity: 0;
    animation: slideUp 1s ease-out forwards;
}

@keyframes slideUp {
    0% {
        transform: translate(-50%, 50%);
        opacity: 0;
    }
    100% {
        transform: translate(-50%, -50%);
        opacity: 1;
    }
}

.banner-content.highlighted {
    padding: 20px 30px;
}

.banner-content.dynamic-overlay {
    position: relative;
}

.banner-content.dynamic-overlay::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    animation: dynamicFade 3s infinite alternate;
    z-index: -1;
}

@keyframes dynamicFade {
    0% {
        opacity: 0.3;
    }
    50% {
        opacity: 0.6;
    }
    100% {
        opacity: 0.3;
    }
}

.gradient-neon {
    background: linear-gradient(90deg, #34A4E0, #FFF);
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 10px rgba(52, 164, 224, 0.8), 0 0 20px rgba(52, 164, 224, 0.6), 0 0 30px rgba(52, 164, 224, 0.4);
    animation: neonPulse 2s infinite alternate;
}

@keyframes neonPulse {
    0% {
        text-shadow: 0 0 10px rgba(52, 164, 224, 0.8), 0 0 20px rgba(52, 164, 224, 0.6), 0 0 30px rgba(52, 164, 224, 0.4);
    }
    100% {
        text-shadow: 0 0 15px rgba(52, 164, 224, 1), 0 0 25px rgba(52, 164, 224, 0.8), 0 0 40px rgba(52, 164, 224, 0.6);
    }
}

.banner-content h1 {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 0 0 20px rgba(52, 164, 224, 1), 0 0 30px rgba(52, 164, 224, 1);
}

.banner-content p {
    font-size: 14px;
    margin-bottom: 20px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.banner-content p.slogan {
    font-size: 24px;
    font-weight: bold;
}

.banner-content .banner-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

    /* ===== MARQUEE ===== */
    .marquee-container {
        width: 100%;
        overflow: hidden;
        background: #1a1a1a;
        padding: 10px 0;
        margin-bottom: 20px;
    }

    .marquee {
        display: inline-block;
        white-space: nowrap;
        animation: marquee 20s linear infinite;
    }

    .marquee:hover {
        animation-play-state: paused;
    }

    .marquee a {
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        margin: 0 30px;
        padding: 8px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .marquee a:hover {
        color: #fff;
        background: #34A4E0;
        box-shadow: 0 0 10px rgba(52, 164, 224, 0.8);
        transform: scale(1.1);
    }

    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        text-align: center;
        margin: 60px 0 40px;
        position: relative;
    }

    .section-title h2 {
        font-size: 2.5em;
        font-weight: 700;
        color: #2c3e50;
        display: inline-block;
        padding: 0 30px;
        background: #fff;
        position: relative;
        z-index: 1;
    }

    .section-title::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #ddd, transparent);
        z-index: 0;
    }

    /* ===== FEATURED PRODUCTS SLIDER ===== */
    .featured-section {
        padding: 0 0 60px 0;
        background: #f8f9fa;
    }

    .post-slider2 {
        position: relative;
        padding: 0 60px;
    }

    .post-slider2 .prev2,
    .post-slider2 .next2 {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: #fff;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .post-slider2 .prev2 {
        left: 10px;
    }

    .post-slider2 .next2 {
        right: 10px;
    }

    .post-slider2 .prev2:hover,
    .post-slider2 .next2:hover {
        background: #667eea;
        color: #fff;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .post-wrapper2 {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        gap: 20px;
        padding: 10px 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .post-wrapper2::-webkit-scrollbar {
        display: none;
    }

    /* ===== PRODUCT CARD ===== */
    .product-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        position: relative;
        min-width: 250px;
        flex: 0 0 auto;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background: #f5f5f5;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: #fff;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        z-index: 2;
    }

    .product-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 2;
    }

    .product-actions a {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.4s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover .product-actions a {
        opacity: 1;
        transform: translateX(0);
    }

    .product-actions a:nth-child(1) {
        transition-delay: 0.1s;
    }

    .product-actions a:nth-child(2) {
        transition-delay: 0.2s;
    }

    .product-actions a i {
        font-size: 18px;
        color: #333;
    }

    .product-actions a:hover {
        background: #667eea;
        transform: scale(1.15);
    }

    .product-actions a:hover i {
        color: #fff;
    }

    .product-info {
        padding: 20px;
    }

    .product-category {
        font-size: 13px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 12px;
        height: 48px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .price-old {
        text-decoration: line-through;
        color: #999;
        font-size: 14px;
    }

    .price-new {
        font-size: 20px;
        font-weight: 700;
        color: #e74c3c;
    }

    /* ===== BRAND CATEGORIES ===== */
    .brand-section {
        padding: 60px 0;
        background: #fff;
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        padding: 0 15px;
    }

    .brand-card {
        height: 200px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #fff;
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .brand-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
    }

    .brand-card:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    .brand-card span {
        position: relative;
        z-index: 1;
    }

    .brand-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .brand-gucci {
        background: linear-gradient(135deg, #ab645b 0%, #8b4a43 100%);
    }

    .brand-dior {
        background: linear-gradient(135deg, #5C9CCA 0%, #4a7ba0 100%);
    }

    .brand-hermes {
        background: linear-gradient(135deg, #C67B36 0%, #a0622b 100%);
    }

    .brand-chanel {
        background: linear-gradient(135deg, #433d3d 0%, #2a2626 100%);
    }

    /* ===== PRODUCT GRID SECTION ===== */
    .products-section {
        padding: 40px 15px 60px;
        background: #f8f9fa;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    /* Reuse product-card styles for grid */
    .products-grid .product-card {
        min-width: auto;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 400px;
        }

        .post-slider .prev,
        .post-slider .next {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .post-slider .prev {
            left: 15px;
        }

        .post-slider .next {
            right: 15px;
        }

        .section-title h2 {
            font-size: 1.8em;
        }

        .post-slider2 {
            padding: 0 50px;
        }

        .brand-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        }

        .brand-card {
            height: 150px;
            font-size: 18px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .product-image {
            height: 220px;
        }

        .marquee a {
            font-size: 14px;
            margin: 0 15px;
            padding: 6px 15px;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            height: 300px;
        }

        .section-title h2 {
            font-size: 1.5em;
            padding: 0 15px;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .brand-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- HERO BANNER -->
<section class="hero-banner">

    <video autoplay muted loop playsinline" class="banner-video">
      <source src="https://res.cloudinary.com/ddtn4zjge/video/upload/v1762400426/Video_ch%C6%B0a_c%C3%B3_ti%C3%AAu_%C4%91%E1%BB%81_%C4%90%C6%B0%E1%BB%A3c_t%E1%BA%A1o_b%E1%BA%B1ng_Clipchamp_1_p5bsxl.mp4" type="video/mp4">
    </video>
     <!-- Lớp phủ tối -->
  <div class="overlay"></div>
    <div class="banner-content highlighted dynamic-overlay">
            <h1>Chào mừng đến với Rise Fitness & Yoga</h1>
            <p class="slogan">Chinh phục vóc dáng, bứt phá giới hạn!</p>
            <div class="banner-buttons">
                <a href="#trial-signup" class="cta-button highlighted rect-button animated">Đăng ký tập thử</a>
                <a href="#products" class="cta-button highlighted rect-button animated">Xem Dịch Vụ</a>
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

<!-- FEATURED PRODUCTS
<section class="featured-section">
    <div class="container">
        <div class="section-title">
            <h2>Sản phẩm nổi bật</h2>
        </div>

        <div class="post-slider2">
            <i class="fa fa-chevron-left prev2" aria-hidden="true"></i>
            <i class="fa fa-chevron-right next2" aria-hidden="true"></i>
            
            <div class="post-wrapper2">
                @foreach($alls->take(10) as $sanpham)
                <div class="product-card">
                    <a href="{{ route('detail', ['id' => $sanpham->id_sanpham]) }}">
                        <div class="product-image">
                            <img src="{{ asset($sanpham->anhsp) }}" alt="{{ $sanpham->tensp }}" onerror="this.src='{{ asset('frontend/upload/placeholder.jpg') }}'">
                            
                            <div class="product-badge">
                                @if($sanpham->giamgia)
                                    -{{ $sanpham->giamgia }}%
                                @else
                                    Mới
                                @endif
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('add_to_cart', $sanpham->id_sanpham) }}" title="Thêm vào giỏ hàng" onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <a href="{{ route('detail', ['id' => $sanpham->id_sanpham]) }}" title="Xem chi tiết">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>

                        <div class="product-info">
                            <div class="product-category">
                                {{ $sanpham->danhmuc->ten_danhmuc }}
                            </div>
                            <div class="product-name">
                                {{ $sanpham->tensp }}
                            </div>
                            <div class="product-price">
                                <span class="price-old">
                                    {{ number_format($sanpham->giasp, 0, ',', '.') }}₫
                                </span>
                                <span class="price-new">
                                    {{ number_format($sanpham->giakhuyenmai, 0, ',', '.') }}₫
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section> -->

<!-- BRAND CATEGORIES -->
<section class="brand-section">
    <div class="container">
        <div class="section-title">
            <h2>Danh mục thương hiệu</h2>
        </div>

        <div class="brand-grid">
            <a href="{{ route('viewAll', ['danhmuc_id' => 9]) }}" class="brand-card brand-gucci">
                <span>Gucci Collection</span>
            </a>
            <a href="{{ route('viewAll', ['danhmuc_id' => 10]) }}" class="brand-card brand-dior">
                <span>Christian Dior</span>
            </a>
            <a href="{{ route('viewAll', ['danhmuc_id' => 11]) }}" class="brand-card brand-hermes">
                <span>Hermès</span>
            </a>
            <a href="{{ route('viewAll', ['danhmuc_id' => 12]) }}" class="brand-card brand-chanel">
                <span>Chanel Luxury</span>
            </a>
        </div>
    </div>
</section>

<!-- GUCCI PRODUCTS -->
<section class="products-section">
    <div class="container">
        <div class="section-title">
            <h2>Túi Gucci</h2>
        </div>

        <div class="products-grid">
            @foreach($gucciProducts as $product)
            <div class="product-card">
                <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}">
                    <div class="product-image">
                        <img src="{{ asset($product->anhsp) }}" alt="{{ $product->tensp }}" onerror="this.src='{{ asset('frontend/upload/placeholder.jpg') }}'">
                        
                        <div class="product-badge">
                            @if($product->giamgia)
                                -{{ $product->giamgia }}%
                            @else
                                Mới
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('add_to_cart', $product->id_sanpham) }}" title="Thêm vào giỏ hàng" onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}" title="Xem chi tiết">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-name">
                            {{ $product->tensp }}
                        </div>
                        <div class="product-price">
                            <span class="price-old">
                                {{ number_format($product->giasp, 0, ',', '.') }}₫
                            </span>
                            <span class="price-new">
                                {{ number_format($product->giakhuyenmai, 0, ',', '.') }}₫
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- DIOR PRODUCTS -->
<section class="products-section" style="background: #fff;">
    <div class="container">
        <div class="section-title">
            <h2>Túi Christian Dior</h2>
        </div>

        <div class="products-grid">
            @foreach($diorProducts as $product)
            <div class="product-card">
                <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}">
                    <div class="product-image">
                        <img src="{{ asset($product->anhsp) }}" alt="{{ $product->tensp }}" onerror="this.src='{{ asset('frontend/upload/placeholder.jpg') }}'">
                        
                        <div class="product-badge">
                            @if($product->giamgia)
                                -{{ $product->giamgia }}%
                            @else
                                Mới
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('add_to_cart', $product->id_sanpham) }}" title="Thêm vào giỏ hàng" onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}" title="Xem chi tiết">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-name">
                            {{ $product->tensp }}
                        </div>
                        <div class="product-price">
                            <span class="price-old">
                                {{ number_format($product->giasp, 0, ',', '.') }}₫
                            </span>
                            <span class="price-new">
                                {{ number_format($product->giakhuyenmai, 0, ',', '.') }}₫
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- HERMES PRODUCTS -->
<section class="products-section">
    <div class="container">
        <div class="section-title">
            <h2>Túi Hermès</h2>
        </div>

        <div class="products-grid">
            @foreach($hermesProducts as $product)
            <div class="product-card">
                <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}">
                    <div class="product-image">
                        <img src="{{ asset($product->anhsp) }}" alt="{{ $product->tensp }}" onerror="this.src='{{ asset('frontend/upload/placeholder.jpg') }}'">
                        
                        <div class="product-badge">
                            @if($product->giamgia)
                                -{{ $product->giamgia }}%
                            @else
                                Mới
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('add_to_cart', $product->id_sanpham) }}" title="Thêm vào giỏ hàng" onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}" title="Xem chi tiết">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-name">
                            {{ $product->tensp }}
                        </div>
                        <div class="product-price">
                            <span class="price-old">
                                {{ number_format($product->giasp, 0, ',', '.') }}₫
                            </span>
                            <span class="price-new">
                                {{ number_format($product->giakhuyenmai, 0, ',', '.') }}₫
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CHANEL PRODUCTS -->
<section class="products-section" style="background: #fff;">
    <div class="container">
        <div class="section-title">
            <h2>Túi Chanel</h2>
        </div>

        <div class="products-grid">
            @foreach($chanelProducts as $product)
            <div class="product-card">
                <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}">
                    <div class="product-image">
                        <img src="{{ asset($product->anhsp) }}" alt="{{ $product->tensp }}" onerror="this.src='{{ asset('frontend/upload/placeholder.jpg') }}'">
                        
                        <div class="product-badge">
                            @if($product->giamgia)
                                -{{ $product->giamgia }}%
                            @else
                                Mới
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('add_to_cart', $product->id_sanpham) }}" title="Thêm vào giỏ hàng" onclick="event.preventDefault(); event.stopPropagation();">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="{{ route('detail', ['id' => $product->id_sanpham]) }}" title="Xem chi tiết">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-name">
                            {{ $product->tensp }}
                        </div>
                        <div class="product-price">
                            <span class="price-old">
                                {{ number_format($product->giasp, 0, ',', '.') }}₫
                            </span>
                            <span class="price-new">
                                {{ number_format($product->giakhuyenmai, 0, ',', '.') }}₫
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection