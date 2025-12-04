<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Sanpham;
use App\Models\Dathang;
use App\Models\Khuyenmai;
use App\Models\ChitietDonhang;

class CartController extends Controller
{
    public function index()
    {
        $products = Sanpham::all();
        return view('products', compact('products'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        $totalOriginal = 0; 
        $totalFinal    = 0; 

        foreach ($cart as $item) {
            $qty          = $item['quantity'] ?? 0;
            $giaGoc       = $item['giasp'] ?? 0;
            $giaKhuyenMai = $item['giakhuyenmai'] ?? $giaGoc;

            $totalOriginal += $giaGoc       * $qty;
            $totalFinal    += $giaKhuyenMai * $qty;
        }

        $totalDiscount = $totalOriginal - $totalFinal; 

        return view('pages.cart', compact(
            'cart',
            'totalOriginal',
            'totalDiscount',
            'totalFinal'
        ));
    }

    public function addToCart($id)
    {
        $product = Sanpham::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id_sanpham" => $product->id_sanpham,
                "tensp" => $product->tensp,
                "anhsp" => $product->anhsp,
                "giasp" => $product->giasp,
                "giamgia" => $product->giamgia,
                "giakhuyenmai" => $product->giakhuyenmai,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        if ($request->ajax()) {
        return response()->json([
            'status'  => 'success',
            'message' => 'Đã thêm vào giỏ hàng thành công!',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function addGoToCart($id)
    {
        $product = Sanpham::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id_sanpham" => $product->id_sanpham,
                "tensp" => $product->tensp,
                "anhsp" => $product->anhsp,
                "giasp" => $product->giasp,
                "giamgia" => $product->giamgia,
                "giakhuyenmai" => $product->giakhuyenmai,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Kiểm tra số lượng hợp lệ
            if ($quantity < 1 || $quantity > 999) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Số lượng không hợp lệ.',
                    'quantity' => $cart[$id]['quantity'] // Trả về số lượng hiện tại để khôi phục
                ], 400);
            }

            // Cập nhật số lượng
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $productTotal = $cart[$id]['giakhuyenmai'] * $quantity;
            // Tính tổng tiền giỏ hàng (giá gốc + khuyến mãi)
            $totalOriginal = 0; 
            $totalFinal    = 0; 

            foreach ($cart as $item) {
                $qty          = $item['quantity'];
                $giaGoc       = $item['giasp'];
                $giaKM        = $item['giakhuyenmai'];

                $totalOriginal += $giaGoc * $qty;
                $totalFinal    += $giaKM  * $qty;
            }

            $totalDiscount = $totalOriginal - $totalFinal; 

            return response()->json([
                'status'         => 'success',
                'product_total'  => $productTotal,
                'total_original' => $totalOriginal,
                'total_discount' => $totalDiscount,
                'total_final'    => $totalFinal,
                'message'        => 'Cập nhật giỏ hàng thành công!'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Sản phẩm không tồn tại trong giỏ hàng.'
        ], 400);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['giakhuyenmai'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'total'   => $total,
        ]);
    }

    public function checkout()
    {
        $user = Auth::user();
        if ($user) {
            $showusers = DB::table('nguoidung')
                ->select('nguoidung.*')
                ->where('nguoidung.id_nd', $user->id_nd)
                ->get();
            return view('pages.checkout', ['showusers' => $showusers]);
        } else {
            return redirect('/login')->with('needLogin', true);
        }
    }

    public function dathang(Request $request)
    {
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->back()->with('error', 'Không có đơn hàng để đặt!');
        }

        // -----------------------------
        // TÍNH TỔNG TIỀN GIỎ HÀNG
        // -----------------------------
        $tongtien = $request->tongtien;
        $tiengiam = 0;
        $tienphaitra = $tongtien;
        $id_km = null;

        // -----------------------------
        // ÁP MÃ KHUYẾN MÃI (NẾU NHẬP)
        // -----------------------------
        if ($request->ma_khuyen_mai) {

            $km = Khuyenmai::where('ma_code', $request->ma_khuyen_mai)
                    ->where('trang_thai', 1)
                    ->first();

            if (!$km) {
                return redirect()->back()->with('error', 'Mã khuyến mãi không hợp lệ!');
            }

            // kiểm tra ngày
            $today = now();
            if ($km->ngay_bat_dau && $today < $km->ngay_bat_dau ||
                $km->ngay_ket_thuc && $today > $km->ngay_ket_thuc) {
                return redirect()->back()->with('error', 'Mã khuyến mãi đã hết hạn!');
            }

            // kiểm tra đơn tối thiểu
            if ($km->don_toi_thieu && $tongtien < $km->don_toi_thieu) {
                return redirect()->back()->with('error', 'Đơn hàng chưa đạt giá trị tối thiểu để áp mã!');
            }

            // kiểm tra số lượt sử dụng
            if ($km->gioi_han_luot !== null && $km->so_luot_da_dung >= $km->gioi_han_luot) {
                return redirect()->back()->with('error', 'Mã khuyến mãi đã hết lượt sử dụng!');
            }

            // -----------------------------
            // TÍNH SỐ TIỀN GIẢM
            // -----------------------------
            if ($km->kieu_giam === 'percent') {
                $tiengiam = ($tongtien * $km->gia_tri_giam) / 100;
            } else {
                $tiengiam = $km->gia_tri_giam;
            }

            // áp max giảm giá nếu có
            if ($km->giam_toi_da && $tiengiam > $km->giam_toi_da) {
                $tiengiam = $km->giam_toi_da;
            }

            // tổng phải trả
            $tienphaitra = max($tongtien - $tiengiam, 0);

            // cập nhật lượt dùng
            $km->increment('so_luot_da_dung');

            $id_km = $km->id_khuyenmai;
        }


        // -----------------------------
        // TẠO ĐƠN HÀNG
        // -----------------------------
        $validatedDataDatHang = [];

        $validatedDataDatHang['tongtien'] = $tongtien;
        if (session()->has('promo')) {
            $validatedDataDatHang['id_khuyenmai'] = session('promo.id');
            $validatedDataDatHang['tiengiam'] = session('promo.discount');
            $validatedDataDatHang['tienphaitra'] = session('promo.new_total');
        } else {
            $validatedDataDatHang['tiengiam'] = 0;
            $validatedDataDatHang['tienphaitra'] = $request->tongtien;
}


        $validatedDataDatHang['ngaygiaohang'] = Carbon::now()->addDay(4);
        $validatedDataDatHang['phuongthucthanhtoan'] = $request->redirect;
        $validatedDataDatHang['diachigiaohang'] = $request->display_diachigiaohang;
        $validatedDataDatHang['hoten'] = $request->display_hoten;
        $validatedDataDatHang['email'] = $request->display_email;
        $validatedDataDatHang['sdt'] = $request->display_sdt;
        $validatedDataDatHang['id_nd'] = Auth::user()->id_nd;

        $dathangCre = Dathang::create($validatedDataDatHang);


        // -----------------------------
        // KIỂM TRA TỒN KHO + TẠO CTDH
        // -----------------------------
        $validatedDataCTDatHang = [];

        foreach (session('cart') as $item) {

            $sanpham = Sanpham::findOrFail($item['id_sanpham']);
            $soluongDaBan = DB::table('chitiet_donhang')
                ->where('id_sanpham', $item['id_sanpham'])
                ->sum('soluong');

            $soluongconlai = $sanpham->soluong - $soluongDaBan;

            if ($item['quantity'] > $soluongconlai) {
                return redirect()->back()->with('error', "Sản phẩm {$sanpham->tensp} không đủ số lượng!");
            }
        }

        foreach (session('cart') as $item) {

            $validatedDataCTDatHang['tensp'] = $item['tensp'];
            $validatedDataCTDatHang['soluong'] = $item['quantity'];
            $validatedDataCTDatHang['giamgia'] = $item['giamgia'];
            $validatedDataCTDatHang['giatien'] = $item['giasp'];
            $validatedDataCTDatHang['giakhuyenmai'] = $item['giakhuyenmai'];
            $validatedDataCTDatHang['id_sanpham'] = $item['id_sanpham'];
            $validatedDataCTDatHang['id_dathang'] = $dathangCre->id_dathang;
            $validatedDataCTDatHang['id_nd'] = Auth::user()->id_nd;

            ChitietDonhang::create($validatedDataCTDatHang);
        }


        // XÓA GIỎ
        session()->forget('cart');

        return view('pages.thongbaodathang');
    }

    public function thongbaodathang(Request $request)
    {
        if ($request->has('vnp_ResponseCode') && $request->has('vnp_TransactionNo')) {
            $responseCode = $request->input('vnp_ResponseCode');

            if ($responseCode == '00') {

                $orderData = session()->get('order_data');
                if ($orderData) {
                    $fakeRequest = Request::create('/', 'POST', $orderData);
                    $fakeRequest->setLaravelSession(app('session')->driver());

                    $this->dathang($fakeRequest);
                    session()->forget('order_data');
                }
                return view('pages.thongbaodathang');
            } else {
                return redirect('/cart')->with('error', 'Thanh toán thất bại.');
            }
        } else {
            return redirect('/cart');
        }
    }

    public function vnpay(Request $request)
    {
        $vnp_TmnCode = "GHHNT2HB"; // Mã website tại VNPAY
        $vnp_HashSecret = "BAGAOHAPRHKQZASKQZASVPRSAKPXNYXS"; // Chuỗi bí mật

        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('/thongbaodathang');;
        $vnp_TxnRef = date("YmdHis"); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';

        $vnp_Amount = $request->tongtien * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        session()->put('order_data', $request->all());
        return redirect($vnp_Url);
    }
    
    public function applyPromo(Request $request)
    {
        $code = $request->promo_code;

        // Tìm mã
        $promo = Khuyenmai::where('ma_code', $code)
                    ->where('trang_thai', 1)
                    ->whereDate('ngay_bat_dau', '<=', now())
                    ->whereDate('ngay_ket_thuc', '>=', now())
                    ->first();

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn!',
            ]);
        }

        // Tính tổng tiền hiện có trong giỏ
        $cart = session('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['giakhuyenmai'] * $item['quantity'];
        }

        // Tính giảm giá
        if ($promo->kieu_giam === 'percent') {
            $discount = ($total * $promo->gia_tri_giam) / 100;
        } else { // money
            $discount = $promo->gia_tri_giam;
        }

        $newTotal = max($total - $discount, 0); // tránh âm tiền

        // Lưu session mã KM để đặt hàng dùng
        session([
            'promo' => [
                'id' => $promo->id_khuyenmai,
                'code' => $promo->ma_code,
                'discount' => $discount,
                'new_total' => $newTotal
            ]
        ]);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'new_total' => $newTotal,
            'message' => 'Áp dụng mã thành công!',
        ]);
    }


}
