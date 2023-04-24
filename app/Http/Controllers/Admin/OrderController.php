<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $svProduct = new ProductService();

        $data = $svProduct->getAll();

        $viewData = [
            'title' => 'Đơn hàng từ san',
            'data' => $data,
        ];

        return view('admin.order.list', $viewData);
    }

    public function edit(Request $request, $id)
    {
        
    }
}