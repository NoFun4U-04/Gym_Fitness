<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý cửa hàng túi xách</title>
    <link rel="shortcut icon" type="image/png" href="/frontend/img/icon.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

    <link rel="stylesheet" href="/frontend/css/bsgrid.min.css" />
    <link rel="stylesheet" href="/frontend/css/style.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    
    <link rel="stylesheet" href="/frontend/css/main.css" />
</head>

<body style="margin: 0; min-height: 100vh; display: flex; flex-direction: column;">

    <header>
     <div class="header">
        <div class="navbar">
            <div class="navbar__left">
                <a href="{{ URL::to('/')}}" class="navbar__logo">
                    <img src="{{ asset('frontend/img/LOGO.png') }}" alt="">
                </a>
                <ul class="navbar__menu-list">
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ URL::to('/') }}" class="hover-a">Trang chủ</a>
                    </li>
                    <li class="{{ request()->is('services') ? 'active' : '' }}">
                        <a href="{{ URL::to('/services') }}" class="hover-a">Giới thiệu </a>
                    </li>
                    <li class="dropdown {{ request()->is('viewAll*') ? 'active' : '' }}" id="sanpham-dropdown">
                        <a href="{{ URL::to('/viewAll') }}" class="hover-a">Sản phẩm </a>
                        <ul class="dropdown-menu" id="dropdown-danhmuc"></ul>
                    </li>
                    <li class="dropdown {{ request()->is('viewAll*') ? 'active' : '' }}" id="sanpham-dropdown">
                        <a href="{{ URL::to('/viewAll') }}" class="hover-a">Dịch vụ </a>
                        <ul class="dropdown-menu" id="dropdown-danhmuc"></ul>
                    </li>
                    <li class="{{ request()->is('donhang') ? 'active' : '' }}">
                        <a href="{{ URL::to('/donhang') }}" class="hover-a">Đăng ký tập thử</a>
                    </li>
                    <li class="{{ request()->is('donhang') ? 'active' : '' }}">
                        <a href="{{ URL::to('/donhang') }}" class="hover-a">Đơn hàng</a>
                    </li>
                </ul>
            </div>

            <div class="navbar__center">
                <form action="{{route('search')}}" method="GET" class="navbar__search">
                    <input type="text" value="" placeholder="Nhập để tìm kiếm..." name="tukhoa" class="search" required>
                    <i class="fa fa-search" id="searchBtn"></i>
                </form>
            </div>

            <div class="navbar__right">
                @if (Auth::check())
                <div class="user-info">
                    <a href="{{ route('profile.show') }}" class="hover-effect user-name-link">
                        {{ Auth::user()->hoten }} <i class="fas fa-user-circle"></i>
                    </a>
                </div>
                <div class="logout">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="border: none; background: transparent; cursor: pointer;"
                                type="submit" id="logoutBtn" class="hover-effect">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
                @else
                <div class="login">
                    <a href="{{ URL::to('login')}}" class="hover-effect">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
                @endif
                <a href="{{ route('cart') }}" class="navbar__shoppingCart hover-effect">
                    <img src="{{ asset('frontend/img/shopping-cart.svg')}}" alt="">
                    @if (session('cart'))
                    <span>{{ count((array) session('cart')) }}</span>
                    @else
                    <span>0</span>
                    @endif
                </a>
            </div>
        </div>
     </div>
    </header>


    <div class="main-content" style="flex:1; padding-top: 60px;"> @yield('content')
    </div>

    <div class="go-to-top"><i class="fas fa-chevron-up"></i></div>

    <footer>
        <div class="footer__info">
            <div class="footer__info-content">
                <h3>Về SACHA</h3>
                <p>Chúng tôi cam kết mang đến những sản phẩm và dịch vụ tốt nhất, luôn đặt trải nghiệm khách hàng lên hàng đầu với sự tận tâm và chuyên nghiệp.</p>
            </div>
            <div class="footer__info-content">
                <h3>Thương hiệu</h3>
                <p><a href="{{ route('viewAll', ['danhmuc_id' => 12]) }}">CHANEL</a></p>
                <p><a href="{{ route('viewAll', ['danhmuc_id' => 10]) }}">CHRISTIAN DIOR</a></p>
                <p><a href="{{ route('viewAll', ['danhmuc_id' => 11]) }}">HERMES</a></p>
                <p><a href="{{ route('viewAll', ['danhmuc_id' => 9]) }}">GUCCI</a></p>
            </div>
            <div class="footer__info-content">
                <h3>Liên hệ</h3>
                <p><i class="fas fa-home"></i> Địa chỉ: Số 12, Chùa Bộc, Đống Đa, Hà Nội</p>
                <p><i class="fas fa-envelope"></i> Email: sacha@gmail.com</p>
                <p><i class="fas fa-phone"></i> Sđt: 1900 1596</p>
                <div class="footer__social">
                    <a href="https://www.facebook.com/hocviennganhang1961" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/tuanphan_272" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Google"><i class="fab fa-google"></i></a>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <center>© 2025 Sacha Shop. All rights reserved.</center>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        let danhMucLoaded = false;

        // Lấy phần tử dropdown sản phẩm
        const sanphamDropdown = document.getElementById('sanpham-dropdown');

        // Tạo một hàm riêng để xử lý việc tải danh mục
        function loadDanhmuc() {
            // Nếu danh mục đã được tải, thoát khỏi hàm
            if (danhMucLoaded) {
                return;
            }

            fetch('/api/danhmuc')
                .then(response => response.json())
                .then(data => {
                    const ul = document.getElementById('dropdown-danhmuc');
                    // Quan trọng: Làm rỗng nội dung của UL trước khi thêm mới
                    ul.innerHTML = '';
                    data.forEach(dm => {
                        const li = document.createElement('li');
                        const a = document.createElement('a');
                        a.href = `/viewAll?danhmuc_id=${dm.id_danhmuc}`;
                        a.textContent = dm.ten_danhmuc;
                        li.appendChild(a);
                        ul.appendChild(li);
                    });
                    danhMucLoaded = true; // Đánh dấu là đã tải xong
                })
                .catch(error => console.error('Lỗi khi tải danh mục:', error));
        }

        // Gắn sự kiện mouseenter cho phần tử dropdown sản phẩm
        if (sanphamDropdown) {
            sanphamDropdown.addEventListener('mouseenter', loadDanhmuc);
        }
    </script>
    <script>
        document.getElementById('logoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Đăng xuất?',
                text: "Bạn có chắc chắn muốn đăng xuất không?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đăng xuất',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
    <script>
        //Slider using Slick (giữ nguyên, đảm bảo các phần tử có class này tồn tại)
        $(document).ready(function() {
            if ($('.post-wrapper').length) { // Chỉ khởi tạo nếu phần tử tồn tại
                $('.post-wrapper').slick({
                    slidesToScroll: 1,
                    autoplay: true,
                    arrow: true,
                    dots: true,
                    autoplaySpeed: 5000,
                    prevArrow: $('.prev'),
                    nextArrow: $('.next'),
                    appendDots: $(".dot"),
                });
            }
        });

        // Slick mutiple carousel (giữ nguyên, đảm bảo các phần tử có class này tồn tại)
        if ($('.post-wrapper2').length) { // Chỉ khởi tạo nếu phần tử tồn tại
            $('.post-wrapper2').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                prevArrow: $('.prev2'),
                nextArrow: $('.next2'),
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 3,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    </script>
    <script src="/frontend/script/script.js"></script>
</body>

</html>