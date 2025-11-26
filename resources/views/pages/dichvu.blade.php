@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/dichvu1.css') }}">
@endpush

<section class="service-banner">
    <div class="banner-content">
        <h1>Dịch Vụ Gym Chuyên Nghiệp</h1>
        <p>
            Nâng cao sức khỏe và thể chất với các thiết bị hiện đại và đội ngũ
            huấn luyện viên chuyên nghiệp tại RiseFitness&Yoga.
        </p>

        <div class="banner-buttons">
            <a href="{{ url('/register') }}" class="btn-primary">Đăng ký tư vấn</a>
        </div>
    </div>
</section>
