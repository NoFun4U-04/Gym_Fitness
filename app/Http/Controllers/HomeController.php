<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Repositories\IProductRepository;
use DB;

class HomeController extends Controller
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /** ===================== HOME PAGE ===================== */
    public function index()
    {
        $alls           = $this->productRepository->allProduct();
        $sanphams       = $this->productRepository->featuredProducts();
        $gucciProducts  = $this->productRepository->getProductsByCategory(9);
        $diorProducts   = $this->productRepository->getProductsByCategory(10);
        $hermesProducts = $this->productRepository->getProductsByCategory(11);
        $chanelProducts = $this->productRepository->getProductsByCategory(12);

        return view('pages.home', compact(
            'alls',
            'sanphams',
            'gucciProducts',
            'diorProducts',
            'hermesProducts',
            'chanelProducts'
        ));
    }

    /** ===================== CATEGORY LIST ===================== */
    public function congiong()
    {
        $danhmucs = Danhmuc::all();
        return view('pages.congiong', compact('danhmucs'));
    }

    /** ===================== DETAIL PAGE ===================== */
    public function detail($id)
    {
        $sanpham = Sanpham::findOrFail($id);

        // Tính số lượng thực tế còn lại
        $soluongDaBan = DB::table('chitiet_donhang')
            ->where('id_sanpham', $id)
            ->sum('soluong');

        $sanpham->soluong = max($sanpham->soluong - $soluongDaBan, 0);

        // Lấy sản phẩm random
        $randoms = $this->productRepository->randomProduct()->take(5);

        // Comment
        $comments = \App\Models\Comment::where('sanpham_id', $id)
            ->with('user')
            ->get();

        return view('pages.detail', compact('sanpham', 'randoms', 'comments'));
    }

    /** ===================== SEARCH ===================== */
    public function search(Request $request)
    {
        $searchs = $this->productRepository->searchProduct($request);

        return view('pages.search', [
            'searchs' => $searchs,
            'tukhoa'  => $request->input('tukhoa')
        ]);
    }

    /** ===================== VIEW ALL ===================== */
    public function viewAll(Request $request)
    {
        $danhmucs = Danhmuc::all();
        $viewAllPaginations = $this->productRepository->getAllByDanhMuc($request);

        return view('pages.viewall', [
            'sanphams' => $viewAllPaginations,
            'danhmucs' => $danhmucs,
        ]);
    }

    /** ===================== SERVICES ===================== */
    public function services()
    {
        $danhmucs = Danhmuc::all();
        return view('pages.services', compact('danhmucs'));
    }

    public function dichvu1()
    {
        return view('pages.dichvu1');   // đúng folder bạn đang có
    }


    /** ===================== ĐĂNG KÝ TẬP THỬ ===================== */
    public function dangKyTapThu()
    {
        $danhmucs = Danhmuc::all();
        return view('pages.dangkitapthu', compact('danhmucs'));
    }
}
