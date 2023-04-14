<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductTypeService;

class ProductTypeController extends Controller
{
    public function index()
    {
        $reJson = [
            'success' => 0,
            'message' => '',
            'data' => []
        ];
        
        $svProductType = new ProductTypeService(); 
        $productTypes = $svProductType->getAll();

        foreach($productTypes as $pt)
            $reJson['data'][] = [
                'code' => $pt->code,
                'title' => $pt->title,
            ];

        $reJson['success'] = 1;
        $reJson['message'] = 'Lấy danh sách thành công.';

        return_label:
        return response()->json($reJson, 200);
    }

    public function create(Request $request)
    {
        $svProductType = new ProductTypeService();

        $reJson = [
            'success' => 0,
            'message' => '',
            'data' => []
        ];
        $json = $request->json()->all();
        if(empty($json))
            $reJson['message'] = 'Chưa có thông tin chủng loại';

        foreach($json as $p){
            $created = 0;

            if($svProductType->create($p))
                $created = 1;

            $reJson['data'][] = [
                'code' => $p['code'],
                'success' => $created 
            ];
        }

        $reJson['success'] = 1;
        $reJson['message'] = 'Tạo mới chủng loại thành công.';

        return_label:
        return response()->json($reJson, 200);
    }
}