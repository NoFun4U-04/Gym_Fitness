@extends('admin_layout')
@section('admin_content')

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

    {{-- ===== KPI ===== --}}
    <div class="row g-3 mb-4">

        <div class="col-sm-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Orders</h5>
                        <i class="bi bi-cart text-primary fs-4"></i>
                    </div>
                    <h2 class="mt-2">{{ $totalsOrders }}</h2>
                    <span class="text-danger">-2.25%</span>
                    <small class="text-muted"> Since last week</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Members</h5>
                        <i class="bi bi-people text-success fs-4"></i>
                    </div>
                    <h2 class="mt-2">{{ $totalsCustomer }}</h2>
                    <span class="text-success">+5.25%</span>
                    <small class="text-muted"> Since last week</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Sales</h5>
                        <i class="bi bi-truck text-primary fs-4"></i>
                    </div>
                    <h2 class="mt-2">{{ $totalsSaleProducts }}</h2>
                    <span class="text-danger">-3.65%</span>
                    <small class="text-muted"> Since last week</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Tổng thu nhập</h5>
                        <i class="bi bi-cash-coin text-success fs-4"></i>
                    </div>
                    <h2 class="mt-2">{{ number_format($totalsMoney,0,',','.') }} đ</h2>
                    <span class="text-success">+6.65%</span>
                    <small class="text-muted"> Since last week</small>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Table Orders ===== --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Orders Mới Nhất</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Thanh toán</th>
                        <th>Ngày đặt</th>
                        <th>Ngày giao</th>
                        <th>Trạng thái</th>
                        <th>Địa chỉ</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($getOrderView as $order)
                        <tr>
                            <td>#{{ $order->id_dathang }}</td>

                            {{-- Payment --}}
                            <td>
                                @if($order->phuongthucthanhtoan == "COD")
                                    <span class="badge bg-secondary">COD</span>
                                @elseif($order->phuongthucthanhtoan == "VNPAY")
                                    <span class="badge bg-primary">VNPAY</span>
                                @else
                                    <span class="badge bg-light text-dark">{{ $order->phuongthucthanhtoan }}</span>
                                @endif
                            </td>

                            <td>{{ $order->ngaydathang }}</td>

                            <td>
                                @if($order->ngaygiaohang)
                                    {{ date('d/m/Y', strtotime($order->ngaygiaohang)) }}
                                @else
                                    —
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @switch($order->trangthai)
                                    @case('đang xử lý')
                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                        @break

                                    @case('chờ lấy hàng')
                                        <span class="badge bg-info text-dark">Chờ lấy hàng</span>
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

                            {{-- Sửa route đúng --}}
                            <td>
                                <a href="{{ route('orders.edit', ['id' => $order->id_dathang]) }}" 
                                   class="btn btn-sm btn-primary">
                                    Edit
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
