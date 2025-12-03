<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gym Admin | Đăng nhập</title>

    <link rel="shortcut icon" type="image/png" href="/frontend/img/LOGO.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --gym-bg: #020617;
            --gym-bg-soft: #0b1120;
            --gym-green: #22c55e;
            --gym-green-soft: rgba(34, 197, 94, 0.18);
            --gym-border: #22c55e33;
            --gym-muted: #9ca3af;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at 0% 0%, rgba(34, 197, 94, 0.12) 0, transparent 55%),
                radial-gradient(circle at 100% 0%, rgba(34, 197, 94, 0.14) 0, transparent 60%),
                linear-gradient(135deg, #020617 0%, #020617 40%, #020617 100%);
            background-color: var(--gym-bg);
        }

        .gym-auth-wrapper {
            width: 100%;
            max-width: 430px;
            padding: 1.5rem;
        }

        .gym-card {
            position: relative;
            background:
                radial-gradient(circle at top left, rgba(34, 197, 94, 0.08) 0, transparent 55%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.7) 0, transparent 55%),
                #020617;
            border-radius: 1.5rem;
            padding: 2.25rem 2.25rem 2.5rem;
            border: 1px solid var(--gym-border);
            box-shadow:
                0 22px 60px rgba(0, 0, 0, 0.9),
                0 0 0 1px rgba(15, 23, 42, 0.9);
            overflow: hidden;
        }

        .gym-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(120deg,
                    rgba(31, 41, 55, 0.3) 0,
                    transparent 25%,
                    rgba(15, 23, 42, 0.6) 50%,
                    transparent 75%,
                    rgba(31, 41, 55, 0.3) 100%);
            opacity: 0.15;
            pointer-events: none;
        }

        .gym-card-inner {
            position: relative;
            z-index: 1;
        }

        .gym-logo-ring {
            width: 70px;
            height: 70px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 30%, #22c55e, #16a34a 40%, #052e16 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.1rem;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.16),
                0 16px 35px rgba(0, 0, 0, 0.85);
        }

        .gym-logo-ring img {
            width: 46px;
            height: 46px;
            border-radius: 999px;
            object-fit: contain;
            background: #020617;
            padding: 6px;
        }

        .gym-title {
			color: #4ade80;
            text-align: center;
            margin-bottom: 0.35rem;
        }

        .gym-title h1 {
			color: #e5e7eb;
            font-size: 1.65rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .gym-title span {
            font-size: 0.8rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gym-green);
        }

        .gym-subtitle {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gym-muted);
            margin-bottom: 1.8rem;
        }

        .gym-subtitle strong {
            color: #e5e7eb;
            font-weight: 500;
        }

        .form-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gym-muted);
            margin-bottom: 0.35rem;
        }

        .form-control {
            border-radius: 999px;
            background-color: #020617;
            border: 1px solid #1f2937;
            color: #e5e7eb;
            font-size: 0.9rem;
            padding: 0.65rem 0.95rem;
            box-shadow: inset 0 0 0 1px rgba(15, 23, 42, 0.85);
        }

        .form-control::placeholder {
            color: #6b7280;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gym-green);
            box-shadow:
                0 0 0 1px rgba(34, 197, 94, 0.7),
                0 0 0 6px rgba(34, 197, 94, 0.18);
            background-color: #020617;
        }

        .form-check-input {
            background-color: #020617;
            border-radius: 0.4rem;
            border: 1px solid #374151;
        }

        .form-check-input:checked {
            background-color: var(--gym-green);
            border-color: var(--gym-green);
        }

        .form-check-label {
            font-size: 0.8rem;
            color: var(--gym-muted);
        }

        .gym-btn-primary {
            border-radius: 999px;
            border: none;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            background-image: linear-gradient(135deg, #22c55e, #4ade80);
            color: #022c22;
            box-shadow:
                0 12px 30px rgba(34, 197, 94, 0.35),
                0 0 0 1px rgba(22, 163, 74, 0.25);
            transition: transform 0.12s ease-out, box-shadow 0.12s ease-out, filter 0.12s ease-out;
        }

        .gym-btn-primary:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
            box-shadow:
                0 18px 45px rgba(34, 197, 94, 0.40),
                0 0 0 1px rgba(22, 163, 74, 0.4);
        }

        .gym-btn-primary:active {
            transform: translateY(1px) scale(0.99);
            box-shadow:
                0 8px 20px rgba(34, 197, 94, 0.35),
                0 0 0 1px rgba(22, 163, 74, 0.4);
        }

        .gym-footnote {
            margin-top: 1.6rem;
            text-align: center;
            font-size: 0.78rem;
            color: #6b7280;
        }

        .gym-footnote span {
            color: var(--gym-green);
            font-weight: 500;
        }

        .gym-alert {
            margin-bottom: 0.9rem;
            font-size: 0.85rem;
            color: #fca5a5;
            background: linear-gradient(to right, rgba(248, 113, 113, 0.08), transparent);
            border-radius: 999px;
            padding: 0.45rem 0.9rem;
            border: 1px solid rgba(248, 113, 113, 0.35);
            text-align: center;
        }

        @media (max-width: 576px) {
            .gym-card {
                padding: 1.75rem 1.4rem 2.1rem;
                border-radius: 1.25rem;
            }

            .gym-title h1 {
                font-size: 1.45rem;
            }
        }
    </style>
</head>

<body>
    <div class="gym-auth-wrapper">
        <div class="gym-card">
            <div class="gym-card-inner">
                <div class="gym-logo-ring">
                    <img src="/frontend/img/LOGO.png" alt="Gym Admin">
                </div>

                <div class="gym-title">
                    <span>Rise Fitness</span>
                    <h1>Admin Panel</h1>
                </div>

                <p class="gym-subtitle">
                    <strong>Đăng nhập</strong> để quản lý hệ thống phòng gym, khách hàng và đơn hàng.
                </p>

                {{-- Thông báo lỗi nếu có --}}
                @php
                    $thongbao = Session::get('thongbao');
                @endphp

                @if ($thongbao)
                    <div class="gym-alert">
                        {{ $thongbao }}
                        @php Session::put('thongbao', null); @endphp
                    </div>
                @endif

                <form action="{{ URL::to('/signinDashboard') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input
                            id="email"
                            class="form-control form-control-lg"
                            type="text"
                            name="email"
                            placeholder="Nhập email admin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input
                            id="password"
                            class="form-control form-control-lg"
                            type="password"
                            name="password"
                            placeholder="Nhập mật khẩu">
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="form-check align-items-center">
                            <input id="remember" type="checkbox" class="form-check-input" value="remember-me"
                                name="remember-me">
                            <label class="form-check-label" for="remember">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="gym-btn-primary">
                            Đăng nhập
                        </button>
                    </div>
                </form>

                <div class="gym-footnote">
                    &copy; {{ date('Y') }} <span>Gym Fitness</span> &mdash; Admin Dashboard
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/js/app.js') }}"></script>
</body>

</html>
