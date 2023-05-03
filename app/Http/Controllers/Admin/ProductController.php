<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiLog;
use App\Models\Product;
use App\Services\SessionService;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $svProduct = new ProductService();

        $data = $svProduct->getList($request);

        $viewData = [
            'title' => 'Quản lý mẫu sản phẩm',
            'data' => $data,
        ];

        return view('admin.product.list', $viewData);
    }

    public function export(Request $request)
    {
        $svProduct = new ProductService();

        $data = $svProduct->getAll()->toArray();

        return Excel::download(new ProductExport($data), 'KHSX-'.date('Y-m-d-H-i-s').'.xlsx', );
    }

    public function edit(Request $request, $id)
    {
        $svProduct = new ProductService();
        $data = $svProduct->find($id);

        $drConfig = [
            'table' => 'product_images',
            'field' => 'product_id',
            'image_storage' => 'product',
            'id' => $id,
            'image_size' => [
                [
                    'size' => 'thumbnail',
                    'width' => 80,
                    'height' => 120
                ]
            ]
        ];
        $drConfig = json_encode($drConfig);
        $drConfig = Crypt::encryptString($drConfig);

        $viewData = [
            'title' => 'Chỉnh sửa thông tin sản phẩm ',
            'data' => $data,
            'drConfig' => $drConfig
        ];
        return view('admin.product.detail', $viewData);
    }

    public function update(Request $request, $id)
    {
        $svSession = new SessionService();
        $svProduct = new ProductService();
        if($svProduct->update([
            'ten_san_pham' => $request->input('ten_san_pham')
        ], $id)){
            $this->pushImagesFast($id);
            $svSession->put('success', 'Cập nhật thành công!');
            return redirect()->route('admin-product-list');
        } else{
            $svSession->put('success', 'Có lỗi trong quá trình xử lý!');
            return redirect()->back();
        }
    }

    public function pushImagesFast($id)
    {
        $mProduct = new Product();
        $data = $mProduct->find($id);
        $link = '';
        foreach ($data->images as $img){
            $link .= ';'.Storage::disk('public_uploads')->url($img->path);
        }
        $link = ltrim($link, ';');
        $body = [
            'bst' => $data->ma_lsx,
            'link' => $link
        ];
        $response = Http::withBasicAuth('fasthn', 'fast$20#09@91')->post('http://pos.sixdo.vn:8080/api/images', $body);
        $log = new ApiLog();
        $log->create([
            'body' => json_encode($body),
            'response' => $response->getBody()
        ]);
        return $response->ok();
    }
}
