<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getModel()
    {
        return Product::class;
    }

    public function getList($request)
    {
        $keyword = $request->input('keyword');
        if (trim($keyword)) {
            $keyword = str_replace(' ', '%', $keyword);
            $this->model->where('ten_san_pham', 'LIKE', $keyword);
        }
        $status = $request->input('status');
        if (trim($status)) {
            $status = str_replace(' ', '%', $status);
            $this->model->where('tinh_trang_san_xuat', 'LIKE', $status);
        }
        $date_start = $request->input('date_start');
        if (trim($date_start)) {
            $this->model->where('ngay_xuat_kho', '>=', $date_start);
        }
        $date_end = $request->input('date_end');
        if (trim($date_end)) {
            $this->model->where('ngay_xuat_kho', '<=', $date_end);
        }
        return $this->model->get();
    }
}