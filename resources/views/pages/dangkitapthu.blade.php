<!-- CSS -->
@extends('layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dangkitapthu.css') }}">
@endpush

@section('content')
    <section class="trial-register-page">
        <div class="trial-register__overlay"></div>

        <div class="trial-register__left">
            <div class="trial-register__image">
                <img src="{{ asset('frontend/img/dangkitapthu-hero.jpg') }}" alt="Đăng ký tập thử">
            </div>

            <div class="trial-register__text">
                <h1>BẮT ĐẦU XÂY DỰNG<br>SỨC KHOẺ<br>NGAY HÔM NAY!</h1>
                <p class="trial-register__sub">
                    Đăng ký nhận ưu đãi tháng<br>
                    hoặc Combo trải nghiệm 7 ngày miễn phí và 2 buổi tập thử cùng Huấn luyện viên tại đây.
                </p>
            </div>
        </div>

        <div class="trial-register__right">
            <div class="trial-register__form-wrapper">
                <h2>Đăng ký tập thử</h2>

                <form action="#" method="POST" class="trial-register__form">
                    @csrf
                    <div class="form-group">
                        <label>Họ và tên <span>*</span></label>
                        <input type="text" name="fullname" placeholder="Nhập tên của bạn (bắt buộc)" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Nhập email của bạn">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại <span>*</span></label>
                        <input type="tel" name="phone" placeholder="Nhập số điện thoại của bạn (bắt buộc)" required>
                    </div>

                    <div class="form-group">
                        <label>Môn thể thao ưa thích</label>
                        <select name="favorite_sport">
                            <option value="">Chọn môn thể thao ưa thích</option>
                            <option value="gym">Gym – Tăng cơ, giảm mỡ</option>
                            <option value="yoga">Yoga</option>
                            <option value="boxing">Boxing</option>
                            <option value="cardio">Cardio</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Cơ sở tập luyện</label>
                        <select name="branch">
                            <option value="">Chọn cơ sở tập luyện</option>
                            <option value="cb">12 Chùa Bộc – Đống Đa</option>
                            <option value="hn2">Cơ sở Hai Bà Trưng</option>
                            <option value="hn3">Cơ sở Cầu Giấy</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Khung giờ tư vấn phù hợp</label>
                        <select name="time_slot">
                            <option value="">Chọn khung giờ tư vấn phù hợp</option>
                            <option value="morning">Sáng (08:00 – 11:00)</option>
                            <option value="afternoon">Chiều (14:00 – 17:00)</option>
                            <option value="evening">Tối (18:00 – 21:00)</option>
                        </select>
                    </div>

                    <button type="submit" class="trial-register__submit">
                        Gửi thông tin
                    </button>

                    <p class="trial-register__note">
                        Bằng việc gửi thông tin, bạn đồng ý cho Rise Fitness liên hệ tư vấn qua điện thoại/Zalo.
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
