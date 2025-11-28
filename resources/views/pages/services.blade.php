<!-- CSS -->
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/services.css') }}">
@endpush


@extends('layout')

@section('content')
<section class="page-header">
    <div class="header-overlay"></div>

    <div class="header-content">
        <h1>VỀ CHÚNG TÔI</h1>
    </div>
</section>

<section class="hero-section">
    <div class="hero-container">
        
        <!-- Left Images -->
        <div class="hero-images">
            <div class="hero-img img-1">
                <img src="/frontend/img/Gioi-thieu/gioi-thieu-2.jpg" alt="Stretching Woman">
            </div>

            <div class="hero-img img-2">
                <img src="/frontend/img/Gioi-thieu/gioi-thieu-3.jpg" alt="Bodybuilder">
            </div>
        </div>

        <!-- Right Content -->
        <div class="hero-content">
            <h1 class="hero-title" id="typingText"
                data-text="Transform your mindset, transform your body.">
            </h1>


            <p class="hero-desc">
               Chúng tôi sẽ thiết kế cho bạn một chương trình dinh dưỡng khoa học và<br> cá nhân hóa,
            giúp giảm cân an toàn, cải thiện vóc dáng, đồng thời nâng<br> cao sức khỏe 
            và tăng cường năng lượng cho toàn bộ cơ thể. Mỗi thực đơn <br>đều được tối 
            ưu theo nhu cầu riêng của bạn, mang lại hiệu quả bền vững <br>và cảm giác 
            tràn đầy sức sống mỗi ngày.
            </p>

            <div class="hero-stats">
                <div class="stat">
                    <h2>999+</h2>
                    <p>Khách hàng thân thiết</p>
                </div>
                <div class="stat">
                    <h2>98%</h2>
                    <p>Tỉ lệ hiệu quả</p>
                </div>
                <div class="stat">
                    <h2>5+</h2>
                    <p>Năm kinh nghiệm thực chiến</p>
                </div>
            </div>
            <a href="#" class="hero-btn">ĐĂNG KÝ</a>
        </div>

    </div>
</section>
<section class="landing-hero">

    <div class="landing-bg"></div>

    <div class="landing-overlay"></div>

    <div class="landing-content">
        <span class="landing-sub">GYM LIFESTYLE</span>
        <h1 class="landing-title">
            Tập đúng – Ăn chuẩn <br> Sở hữu body mơ ước
        </h1>
        <p class="landing-desc">
            Chúng tôi cung cấp các sản phẩm hỗ trợ tập luyện, phụ kiện gym và đồ thể thao cao cấp.<br>
            Giúp bạn duy trì động lực và đạt hiệu quả tối đa trong từng buổi tập.
        </p>
        <a href="#" class="hero-btn">KHÁM PHÁ SẢN PHẨM</a>
    </div>
</section>

<section class="stats-section">
    <div class="stats-header">
        <h2>Hành trình đến <span>body lý tưởng</span> của bạn bắt đầu từ đây.</h2>
        <p>Hàng nghìn người đã thay đổi cuộc sống của họ tốt hơn từng ngày.</p>
    </div>

    <div class="stats-container">
        <div class="stat-box">
            <h1 class="count" data-target="78">0</h1>
            <p>Thiết bị tập luyện</p>
        </div>

        <div class="stat-box">
            <h1 class="count" data-target="23">0</h1>
            <p>Huấn luyện viên chuyên nghiệp</p>
        </div>

        <div class="stat-box">
            <h1 class="count" data-target="999">0</h1>
            <p>Khách hàng thân thiết</p>
        </div>

        <div class="stat-box">
            <h1 class="count" data-target="16">0</h1>
            <p>Chương trình luyện tập</p>
        </div>
    </div>
</section>

<script>
    const el = document.getElementById("typingText");
    const text = el.dataset.text;
    let i = 0;

    function type() {
        if (i < text.length) {
            el.textContent = text.substring(0, i + 1);
            i++;
            setTimeout(type, 40);
        }
    }

    window.onload = type;
</script>
<script>
    const counters = document.querySelectorAll('.count');

    counters.forEach(counter => {
        counter.innerText = "0";
        const updateCounter = () => {
            const target = +counter.getAttribute('data-target');
            const current = +counter.innerText;
            const increment = target / 100;

            if (current < target) {
                counter.innerText = `${Math.ceil(current + increment)}`;
                setTimeout(updateCounter, 20);
            } else {
                counter.innerText = target >= 999 ? (target + "+") : target;
            }
        };

        updateCounter();
    });
</script>

@endsection