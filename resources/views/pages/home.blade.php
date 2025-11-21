@extends('layout')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@endpush


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
@push('scripts')
<script src="{{ asset('frontend/script/about.js') }}"></script>
@endpush


