@extends('admin_layout')
@section('admin_content')

<style>
/* ======================= KPI CARDS ======================= */
.kpi-card {
    border-radius: 16px;
    padding: 22px;
    background: #ffffff;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: 0.25s ease;
}
.kpi-card:hover {
    transform: translateY(-3px);
}

.kpi-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 22px;
}

.kpi-title {
    font-size: 15px;
    font-weight: 600;
    color: #6b7280;
}

.kpi-value {
    font-size: 30px;
    font-weight: 800;
    margin-top: 6px;
}

/* ======================= TABLE ======================= */
.table-card {
    border-radius: 16px;
    overflow: hidden;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.table thead th {
    background: #0f172a !important;
    color: #fff !important;
    padding: 14px 10px;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.table tbody tr:hover {
    background: #f8fafc;
}

.badge {
    padding: 8px 12px;
    font-size: 12px;
    border-radius: 8px;
}

.btn-edit {
    padding: 6px 12px;
    border-radius: 10px;
}
</style>


<div class="container-fluid p-0">

    <h1 class="h3 mb-4 fw-bold"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>

    {{-- ======================== KPI ROW ======================== --}}
    <div class="row g-4 mb-4">

        {{-- Orders --}}
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="kpi-title">Đơn hàng</p>
                    <div class="kpi-icon bg-blue-100 text-primary">
                        <i class="bi bi-cart-check"></i>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalsOrders }}</div>
                <small class="text-danger fw-semibold">-2.25% tuần trước</small>
            </div>
        </div>

        {{-- Members --}}
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="kpi-title">Thành viên</p>
                    <div class="kpi-icon bg-green-100 text-success">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalsCustomer }}</div>
                <small class="text-success fw-semibold">+5.25% tuần trước</small>
            </div>
        </div>

        {{-- Sales --}}
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="kpi-title">Sản phẩm đã bán</p>
                    <div class="kpi-icon bg-purple-100 text-purple">
                        <i class="bi bi-bag"></i>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalsSaleProducts }}</div>
                <small class="text-danger fw-semibold">-3.65% tuần trước</small>
            </div>
        </div>

        {{-- Income --}}
        <div class="col-md-3">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="kpi-title">Tổng thu nhập</p>
                    <div class="kpi-icon bg-yellow-100 text-warning">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
                <div class="kpi-value">{{ number_format($totalsMoney,0,',','.') }} đ</div>
                <small class="text-success fw-semibold">+6.65% tuần trước</small>
            </div>
        </div>

    </div>

    {{-- ======================== TABLE ORDERS ======================== --}}
    <div class="table-card">

        <div class="card-header bg-white py-3 px-4">
            <h5 class="fw-bold mb-0"><i class="bi bi-list-check me-2"></i>Đơn hàng mới nhất</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thanh toán</th>
                        <th>Ngày đặt</th>
                        <th>Ngày giao</th>
                        <th>Trạng thái</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($getOrderView as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id_dathang }}</td>

                        {{-- Payment --}}
                        <td>
                            @if($order->phuongthucthanhtoan == "COD")
                                <span class="badge bg-secondary">COD</span>
                            @elseif($order->phuongthucthanhtoan == "VNPAY")
                                <span class="badge bg-primary">VNPAY</span>
                            @else
                                <span class="badge bg-dark">{{ $order->phuongthucthanhtoan }}</span>
                            @endif
                        </td>

                        <td>{{ $order->ngaydathang }}</td>

                        <td>
                            {{ $order->ngaygiaohang ? date('d/m/Y', strtotime($order->ngaygiaohang)) : '—' }}
                        </td>

                        {{-- Status --}}
                        <td>
                            @switch($order->trangthai)
                                @case('đang xử lý')
                                    <span class="badge bg-warning text-dark">Đang xử lý</span>
                                @break

                                @case('chờ lấy hàng')
                                    <span class="badge bg-info text-dark">Chờ lấy</span>
                                @break

                                @case('đang giao hàng')
                                    <span class="badge bg-primary">Đang giao</span>
                                @break

                                @case('giao thành công')
                                    <span class="badge bg-success">Thành công</span>
                                @break

                                @default
                                    <span class="badge bg-danger">{{ $order->trangthai }}</span>
                            @endswitch
                        </td>

                        <td>{{ $order->diachigiaohang }}</td>

                        <td>
                            <a href="{{ route('orders.edit', ['id' => $order->id_dathang]) }}" 
                               class="btn btn-sm btn-primary btn-edit">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
