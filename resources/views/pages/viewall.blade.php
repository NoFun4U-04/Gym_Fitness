@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/sanpham.css') }}">
@endpush
@extends('layout')
@section('content')



<section class="page-header">
    <div class="header-overlay"></div>
    <div class="header-content">
            @php
                $ten = 'TẤT CẢ SẢN PHẨM';

                if (request('category')) {
                    $dm = $danhmucs->firstWhere('id_danhmuc', request('category'));
                    if ($dm) {
                        $ten = 'SẢN PHẨM: ' . strtoupper($dm->ten_danhmuc);
                    }
                }
            @endphp

            <h1 class="page-title">{{ $ten }}</h1>   
    </div>
</section>
<!-- Tất cả sản phẩm -->
<div class="body">
        <div>
            <div class="row">
                @foreach($sanphams as $sanpham)
                <div class="col-lg-2_5 col-md-4 col-6 post2">
                    <a href="{{ route('detail', ['id' => $sanpham->id_sanpham]) }}">
                        <div class="product">
                            <div class="product__img">
                                <div class="product-slider">
                                        @php
                                            $images = $sanpham->images ?? collect();
                                        @endphp

                                        @if($images->isNotEmpty())
                                            @foreach($images as $index => $img)
                                                <img
                                                    class="slide {{ $index === 0 ? 'active' : '' }}"
                                                    src="{{ asset($img->duong_dan) }}"
                                                    alt="{{ $sanpham->tensp }}"
                                                >
                                            @endforeach
                                        @else
                                            <img
                                                class="slide active"
                                                src="{{ asset('frontend/upload/placeholder.jpg') }}"
                                                alt="{{ $sanpham->tensp }}">
                                        @endif

                                        <div class="product-slider-dots">
                                            @php $total = max($images->count(), 1); @endphp
                                            @for($i = 0; $i < $total; $i++)
                                                <span class="product-slider-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></span>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            <div class="box-icon-new-product">
                                <a href="{{ route('add_to_cart', $sanpham->id_sanpham) }}" title="Thêm vào giỏ hàng">
                                    <i style="font-size: 19px;" id="cart-Product" class="cart-product fa-solid fa-cart-shopping"></i>
                                </a>
                                {{-- <a href="{{ route('wishlist_add', $sanpham->id_sanpham) }}" title="Thêm vào yêu thích">
                                <i style="font-size: 18px;" id="heart-Product" class="fa-solid fa-heart"></i>
                    </a> --}}
                    <a href="{{ route('detail', ['id' => $sanpham->id_sanpham]) }}" title="Xem chi tiết sản phẩm">
                        <i style="font-size: 18px;" id="search-Product" class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>

                <div class="product__sale">
                    <div>
                        @if($sanpham->giamgia)
                        -{{$sanpham->giamgia}}%
                        @else Mới
                        @endif
                    </div>
                </div>

                <div class="product__content">
                    {{-- Added product brand for consistency --}}
                    @if(isset($sanpham->danhmuc->ten_danhmuc))
                    <div class="product__brand">
                        {{ $sanpham->danhmuc->ten_danhmuc }}
                    </div>
                    @endif
                    <div class="product__title">
                        {{$sanpham->tensp}}
                    </div>

                    <div class="product__pride-oldPride">
                        <span class="Price">
                            <bdi>
                                {{ number_format($sanpham->giasp, 0, ',', '.') }}
                                <span class="currencySymbol">₫</span>
                            </bdi>
                        </span>
                    </div>

                    <div class="product__pride-newPride">
                        <span class="Price">
                            <bdi>
                                {{ number_format($sanpham->giakhuyenmai, 0, ',', '.') }}
                                <span class="currencySymbol">₫</span>
                            </bdi>
                        </span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item @if($sanphams->currentPage() === 1) disabled @endif">
                <a class="page-link" href="{{ $sanphams->appends(request()->query())->previousPageUrl() }}">
                    &laquo;
                </a>
            </li>
            @for ($i = 1; $i <= $sanphams->lastPage(); $i++)
                <li class="page-item @if($sanphams->currentPage() === $i) active @endif">
                    <a class="page-link" href="{{ $sanphams->appends(request()->query())->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <li class="page-item @if($sanphams->currentPage() === $sanphams->lastPage()) disabled @endif">
                    <a class="page-link" href="{{ $sanphams->appends(request()->query())->nextPageUrl() }}">
                        &raquo;
                    </a>
                </li>
        </ul>
    </nav>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.product-slider');

        sliders.forEach((slider) => {
            const slides = slider.querySelectorAll('img.slide');
            const dots = slider.querySelectorAll('.product-slider-dot');

            if (slides.length === 0) return;

            let currentIndex = 0;
            const intervalMs = 3000;

            function showSlide(index) {
                slides.forEach((img, i) => {
                    img.classList.toggle('active', i === index);
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
                currentIndex = index;
            }

            let timer = setInterval(() => {
                const nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }, intervalMs);

            dots.forEach((dot) => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.getAttribute('data-index'), 10);
                    showSlide(index);
                    clearInterval(timer);
                    timer = setInterval(() => {
                        const nextIndex = (currentIndex + 1) % slides.length;
                        showSlide(nextIndex);
                    }, intervalMs);
                });
            });

            const productCard = slider.closest('.product');
            if (productCard) {
                productCard.addEventListener('mouseenter', () => clearInterval(timer));
                productCard.addEventListener('mouseleave', () => {
                    clearInterval(timer);
                    timer = setInterval(() => {
                        const nextIndex = (currentIndex + 1) % slides.length;
                        showSlide(nextIndex);
                    }, intervalMs);
                });
            }
        });
    });
</script>
@endsection