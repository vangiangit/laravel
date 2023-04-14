<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $svProduct = new ProductService();

        $reJson = [
            'success' => 0,
            'message' => '',
            'data' => []
        ];
        $json = $request->json()->all();
        if(empty($json))
            $reJson['message'] = 'Chưa có thông tin sản phẩm';

        foreach($json as $p){
            $created = 0;

            if($svProduct->upsert($p))
                $created = 1;

            $reJson['data'][] = [
                'bst' => $p['bst'],
                'success' => $created
            ];
        }

        $reJson['success'] = 1;
        $reJson['message'] = 'Tạo mới sản phẩm thành công.';

        return_label:
        return response()->json($reJson, 200);
    }
}
