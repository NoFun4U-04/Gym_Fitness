@extends('layout')
@section('content')

<style>
.orders-hero {
    width: 100%;
    height: 520px;
    background-image: url('/frontend/img/donhang.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: flex-end;
}

.orders-hero-content {
    padding: 30px 40px;
    color: #ffffff;
}

.orders-page {
    padding: 40px 0 80px;
    background: #ffffff;
    width: 100%;
}

.orders-wrapper {
    width: 100%;
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 40px 0; 
}

.orders-heading {
    margin-bottom: 14px;
}

.orders-breadcrumb {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #6b7280;
}

.orders-breadcrumb a {
    color: #00c896;
    text-decoration: none;
}

.orders-breadcrumb span {
    color: #9ca3af;
}

.orders-title {
    font-size: 32px;
    font-weight: 700;
    color: #0b1120;
    margin: 6px 0 4px;
}

.orders-subtitle {
    font-size: 14px;
    color: #6b7280;
}

.orders-card {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
}

.orders-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #0b1120;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 14px 32px rgba(0, 0, 0, 0.18);
    font-size: 16px;
}

.orders-table thead tr {
    background: #020617;
}

.orders-table thead th {
    padding: 16px 18px;
    text-align: left;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    color: #f9fafb;
    white-space: nowrap;
}

.orders-table tbody tr {
    background: #0f1624;
}

.orders-table tbody tr + tr td {
    border-top: 1px solid #1f2937;
}

.orders-table td {
    padding: 16px 18px;
    color: #e5e7eb;
    font-size: 16px;
}

.orders-table td:first-child {
    font-weight: 700;
    color: #22c55e;
}

.badge-payment {
    display: inline-block;
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 999px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(0,200,255,0.6);
    color: #c9e9ff;
}

.badge-status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 14px;
    margin-top: 4px;
}

.badge-status--processing {
    background: rgba(186, 141, 55, 0.16);
    border: 1px solid rgba(206, 156, 60, 0.8);
    color: #f2cb7a;
}

.badge-status--success {
    background: rgba(34,197,94,0.16);
    border: 1px solid rgba(52,211,153,0.6);
    color: #6ee7b7;
}

.badge-status--warning {
    background: rgba(234,179,8,0.14);
    border: 1px solid rgba(251,191,36,0.65);
    color: #fcd34d;
}

.orders-action-link {
    display: inline-block;
    padding: 8px 14px;
    font-size: 12px;
    border-radius: 10px;
    border: 1px solid rgba(0,200,255,0.6);
    color: #c9e9ff;
    text-decoration: none;
    margin-right: 6px;
    transition: 0.15s;
    background: rgba(255,255,255,0.04);
}

.orders-action-link:hover {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: white;
}

.orders-action-link--danger {
    border-color: rgba(255,70,70,0.75);
    color: #ffd7d7;
}

.orders-action-link--danger:hover {
    background: linear-gradient(135deg, #ff4b4b, #ff1c3d);
    color: white;
}

.orders-empty-row {
    text-align: center;
    padding: 24px 14px;
    font-size: 14px;
    color: #cbd5e1;
}

@media (max-width: 768px) {
    .orders-wrapper {
        padding: 0 18px;
    }

    .orders-title {
        font-size: 26px;
    }

    .orders-table thead th {
        font-size: 11px;
        padding: 10px;
    }

    .orders-table td {
        padding: 12px 10px;
    }
}
</style>

<div class="orders-hero">
    <div class="orders-hero-content">
        <h1></h1>
        <div class="orders-hero-breadcrumb"></div>
    </div>
</div>

<div class="orders-page">
    <div class="orders-wrapper">
        <div class="orders-heading">
            <div class="orders-breadcrumb">
                <a href="{{ url('/') }}">Trang chủ</a> <span>/ Đơn hàng</span>
            </div>
            <h2 class="orders-title">Danh sách đơn hàng</h2>
            <p class="orders-subtitle">Theo dõi lịch sử mua hàng tại RISE FITNESS &amp; YOGA</p>
        </div>

        <div class="orders-card">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thanh toán</th>
                        <th>Ngày đặt</th>
                        <th>Ngày giao dự kiến</th>
                        <th>Trạng thái</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $i => $order)
                        <tr>
                            <td>{{ $i + 1 }}</td>

                            <td>
                                <span class="badge-payment">{{ $order->phuongthucthanhtoan }}</span>
                            </td>

                            <td>
                                {{ $order->ngaydathang
                                    ? \Carbon\Carbon::parse($order->ngaydathang)->format('d-m-Y')
                                    : '---' }}
                            </td>

                            <td>
                                {{ $order->ngaygiaohang
                                    ? \Carbon\Carbon::parse($order->ngaygiaohang)->format('d-m-Y')
                                    : '---' }}
                            </td>

                            <td>
                                @php
                                    $status = strtolower($order->trangthai);
                                @endphp

                                @if(in_array($status, ['đang xử lý', 'chờ lấy hàng', 'đang giao hàng']))
                                    <span class="badge-status badge-status--processing">{{ $order->trangthai }}</span>

                                @elseif(in_array($status, ['giao thành công', 'đã hoàn thành']))
                                    <span class="badge-status badge-status--success">{{ $order->trangthai }}</span>

                                @elseif(in_array($status, ['đã hủy', 'hủy đơn', 'cancel']))
                                    <span class="badge-status badge-status--warning">{{ $order->trangthai }}</span>

                                @else
                                    <span class="badge-status">{{ $order->trangthai }}</span>
                                @endif
                            </td>

                            <td>{{ $order->diachigiaohang ?? '---' }}</td>

                            <td>
                                <a href="{{ route('donhang.edit', ['id' => $order->id_dathang]) }}" 
                                    class="orders-action-link">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="orders-empty-row">
                                Bạn chưa có đơn hàng nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
