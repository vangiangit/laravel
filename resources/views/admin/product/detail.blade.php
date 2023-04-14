@extends('admin.layout.main')

@section('page-title')
    {{$title}}
@endsection

@section('module-title')
    {{$title}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <h2>Thông tin sản phẩm</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="detail-info">
                        <span>BST</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Chủng loại</span>
                        <p>{{$data['chung_loai']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Mã LSX</span>
                        <p>{{$data['ma_lsx']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Mã hàng</span>
                        <p>{{$data['ma_hang']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Mã vải</span>
                        <p>{{$data['loai_vai_su_dung']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày chuyển LSX</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_chuyen_lsx']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tình trạng NPL</span>
                        <p>{{$data['tinh_trang_npl']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày cấp NPL thực tế</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nk_du_kien']))}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="detail-info">
                        <span>Giải trình</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>SL nhập kho</span>
                        <p>{{number_format($data['sl_nhap'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>SL cắt thực tế</span>
                        <p>{{number_format($data['sl_cat_thuc_te'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Đơn vị gia công</span>
                        <p>{{$data['don_vi_gia_cong']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày dự kiến nhập kho</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nk_du_kien']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tình trạng sản xuất</span>
                        <p>{{$data['tinh_trang_san_xuat']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Giải trình</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày nhập kho thực tế</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nhan_hang']))}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="detail-info">
                        <span>Ngày xuất kho</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_xuat_kho']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Giải trình</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày nhận mẫu MKT</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nhan_mau_mkt']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tháng ra hàng dự kiến</span>
                        <p>{{date('d/m/Y', strtotime($data['thang_ra_ch']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số ct</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày ct</span>
                        <p>{{date('d/m/Y', strtotime($data['thang_ra_ch']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Trạng thái</span>
                        <p>{{$data['tinh_trang_san_xuat']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <form method="post" action="{{route('admin-product-update', ['id' => $data['id']])}}">
                <h2>Ảnh sản phẩm</h2>
                @include('admin.elements.dropzone', [
                    'config' => $drConfig,
                    'maxFiles' => 100,
                    'name' => 'image'
                ])
                <h2>Tên sản phẩm</h2>
                <input id="ten_san_pham" name="ten_san_pham" class="form-control" value="{{$data['ten_san_pham']}}" type="text"/>
                <div class="mt-3">
                    <div class="row row-btn">
                        <div class="col-6">
                            <button class="btn btn-danger">Huỷ</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-success">Lưu</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection
