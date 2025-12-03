<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Danhmuc;
use App\Http\Controllers\Controller;
use App\Repositories\IProductRepository;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /* ==================== HÀM RESIZE ẢNH ==================== */
    private function resizeImageKeepRatio($sourcePath, $destPath, $maxWidth = 800, $maxHeight = 800)
    {
        list($origWidth, $origHeight, $imageType) = getimagesize($sourcePath);

        $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);

        if ($ratio >= 1) {
            copy($sourcePath, $destPath);
            return true;
        }

        $newWidth = intval($origWidth * $ratio);
        $newHeight = intval($origHeight * $ratio);

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($sourcePath);
                break;
            default:
                return false;
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Giữ độ trong suốt cho PNG/GIF
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
            imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }

        imagecopyresampled(
            $newImage,
            $image,
            0, 0, 0, 0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($newImage, $destPath, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($newImage, $destPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($newImage, $destPath);
                break;
        }

        imagedestroy($image);
        imagedestroy($newImage);

        return true;
    }

    


    /* ==================== INDEX ==================== */
    public function index(Request $request)
    {
        // lấy danh sách sản phẩm đã lọc
        $sanphams = $this->productRepository->filterProducts($request);

        // danh mục
        $danhmucs = Danhmuc::all();

        // thống kê
        $stats = [
            'total'   => $sanphams->count(),
            'instock' => $sanphams->where('soluong', '>=', 10)->count(),
            'low'     => $sanphams->where('soluong', '>', 0)->where('soluong', '<', 10)->count(),
            'out'     => $sanphams->where('soluong', '=', 0)->count(),
        ];

        return view('admin.products.index', compact('sanphams', 'danhmucs', 'stats'));
    }



    /* ==================== CREATE ==================== */
    public function create()
    {
        $list_danhmucs = Danhmuc::all();
        return view('admin.products.create', compact('list_danhmucs'));
    }

    /* ==================== STORE ==================== */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tensp'           => 'required',
            'sku'             => 'nullable|string',
            'anhsp'           => 'required|image',
            'giasp'           => 'required|numeric',
            'giakhuyenmai'    => 'nullable|numeric',
            'giamgia'         => 'nullable|numeric',
            'gia_duoc_giam'   =>'nullable|numeric',
            'mota'            => 'nullable',
            'mota_ngan'       => 'nullable|string',
            'soluong'         => 'required|numeric',
            'id_danhmuc'      => 'required',
            'noi_bat'          => 'numeric'
        ]);

        // Kiểm tra trùng tên
        if ($this->productRepository->findByName($validatedData['tensp'])) {
            return back()->withInput()->withErrors(['tensp' => 'Tên sản phẩm đã tồn tại']);
        }

        /* ----- XỬ LÝ UPLOAD + RESIZE ẢNH ----- */
        $image = $request->file('anhsp');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destination = public_path('frontend/upload');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $sourcePath = $image->getRealPath();
        $destPath   = $destination . '/' . $imageName;

        $this->resizeImageKeepRatio($sourcePath, $destPath);

        $validatedData['anhsp'] = "frontend/upload/" . $imageName;
        /* LƯU */
        $this->productRepository->storeProduct($validatedData);

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    /* ==================== EDIT ==================== */
    public function edit($id)
    {
        $sp = $this->productRepository->findProduct($id);
        $list_danhmucs = Danhmuc::all();


        return view('admin.products.edit', compact('sp', 'list_danhmucs'));
    }

    /* ==================== UPDATE ==================== */
    public function update($id, Request $request)
    {
         $validatedData = $request->validate([
            'tensp'           => 'required',
            'sku'             => 'nullable|string',
            'anhsp'           => 'image',
            'giasp'           => 'required|numeric',
            'giakhuyenmai'    => 'nullable|numeric',
            'giamgia'         => 'nullable|numeric',
            'gia_duoc_giam'   =>'nullable|numeric',
            'mota'            => 'nullable',
            'mota_ngan'       => 'nullable|string',
            'soluong'         => 'required|numeric',
            'id_danhmuc'      => 'required',
            'noi_bat'         => 'numeric',
            'trang_thai'      => 'numeric'
        ]);

        /* ----- ẢNH ----- */
        if ($request->file('anhsp')) {
            $image = $request->file('anhsp');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destination = public_path('frontend/upload');
            if (!file_exists($destination)) mkdir($destination, 0755, true);

            $source = $image->getRealPath();
            $dest = $destination . '/' . $imageName;

            $this->resizeImageKeepRatio($source, $dest);
            $validatedData['anhsp'] = "frontend/upload/" . $imageName;
        } else {
            $validatedData['anhsp'] = $request->anhsp1; // giữ ảnh cũ
        }


        /* CẬP NHẬT */
        $this->productRepository->updateProduct($validatedData, $id);

        return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
    }

    /* ==================== DELETE ==================== */
    public function destroy($id)
    {
        $this->productRepository->softDelete($id);

        return redirect()
            ->route('product.index')
            ->with('success', 'Sản phẩm đã được chuyển sang trạng thái ẩn');
    }

}
