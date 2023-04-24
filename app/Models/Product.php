<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\ProductImage;

class Product extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bst',
        'ma_hang' ,
        'ten_san_pham' ,
        'ma_lsx' ,
        'chung_loai' ,
        'hinh_anh' ,
        'loai_vai_su_dung' ,
        'ngay_chuyen_lsx' ,
        'tinh_trang_npl' ,
        'sl_du_kien' ,
        'ngay_nhan_lsx' ,
        'ngay_tra_lsx' ,
        'ngay_cap_vai' ,
        'ngay_cap_npl' ,
        'ngay_cat' ,
        'sl_cat_thuc_te' ,
        'don_vi_gia_cong' ,
        'tinh_trang_san_xuat',
        'ngay_nk_du_kien' ,
        'ngay_nhan_hang' ,
        'sl_nhan' ,
        'ngay_nhap_kho' ,
        'sl_nhap' ,
        'ngay_xuat_kho' ,
        'sl_xuat' ,
        'ngay_nhan_mau_mkt' ,
        'thang_ra_ch' ,
        'ghi_chu',
        'ten_san_pham',
        'so_luong_du_kien'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
