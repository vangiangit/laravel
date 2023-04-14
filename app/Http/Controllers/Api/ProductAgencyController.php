<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductAgencyService;

class ProductAgencyController extends Controller
{
    public function index()
    {
        $reJson = [
            'success' => 0,
            'message' => '',
            'data' => []
        ];
        
        $svProductAgency = new ProductAgencyService(); 
        $productAgency = $svProductAgency->getAll();

        foreach($productAgency as $pt)
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
        $svProductAgency = new ProductAgencyService();

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

            if($svProductAgency->create($p))
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