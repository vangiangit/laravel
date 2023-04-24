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
                        <span>Mã vải</span>
                        <p>{{$data['loai_vai_su_dung']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số lượng dự kiến</span>
                        <p>{{number_format($data['so_luong_du_kien'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tình trạng NPL</span>
                        <p>{{$data['tinh_trang_npl']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày chuyển LSX</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_chuyen_lsx']))}}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="detail-info">
                        <span>Ngày nhận LSX</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nhan_lsx']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày trả LSX</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_tra_lsx']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày cấp vải</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_cap_vai']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày cấp NPL</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_cap_npl']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày cắt</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_cat']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số lượng cắt thực tế</span>
                        <p>{{number_format($data['sl_cat_thuc_te'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Đơn vị gia công</span>
                        <p>{{$data['don_vi_gia_cong']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tình trạng sản xuất</span>
                        <p>{{$data['tinh_trang_san_xuat']}}</p>
                    </div>                   
                </div>
                <div class="col-lg-4">
                    <div class="detail-info">
                        <span>Ngày nhập kho dự kiến</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nk_du_kien']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày nhập hàng</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nhan_hang']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số lượng hàng nhận</span>
                        <p>{{number_format($data['sl_cat_thuc_te'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày xuất kho</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_xuat_kho']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số lượng nhập kho</span>
                        <p>{{number_format($data['sl_cat_thuc_te'], 0, ',', '.')}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày xuất kho</span>
                        <p>{{date('d/m/Y', strtotime($data['thang_ra_ch']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Ngày nhận mẫu MKT</span>
                        <p>{{date('d/m/Y', strtotime($data['ngay_nhan_mau_mkt']))}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Số ct</span>
                        <p>{{$data['bst']}}</p>
                    </div>
                    <div class="detail-info">
                        <span>Tháng ra cửa hàng</span>
                        <p>{{date('d/m/Y', strtotime($data['thang_ra_ch']))}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <form method="post" action="{{route('admin-product-update', ['id' => $data['id']])}}">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Ảnh sản phẩm</h2>
                    <a id="edit-image-detail" href="javascript:void(0);"><i class="far fa-edit"></i> Chỉnh sửa ảnh</a>
                </div>
                <div class="images-preview row">
                    <div class="col-2 list-thumb">
                        @foreach ($data['images'] as $item)
                            <a href="javascript:void(0);"><img class="img-fluid" src="{{ str_replace('/original/', '/original/', Storage::disk('public_uploads')->url('') . '/' . $item['path'])}}" /></a>
                        @endforeach
                    </div>
                    <div class="col-10">
                        @if(!empty($data['images']) && isset($data['images'][0]))
                            <img id="image-detail" class="img-fluid" src="{{ str_replace('/original/', '/original/', Storage::disk('public_uploads')->url('') . '/' . $data['images'][0]['path'])}}" />                                            
                        @endif
                    </div>
                </div>
                <div class="images-dropzone d-none">
                    @include('admin.elements.dropzone', [
                        'config' => $drConfig,
                        'maxFiles' => 100,
                        'name' => 'image'
                    ])
                </div>
                <h2 class="mt-3">Tên sản phẩm</h2>
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

@once
    @push('custom_script_footer')
        <script>
            $('.list-thumb a img').click(function(){
                $('#image-detail').attr('src', $(this).attr('src'));
            });

            $('#edit-image-detail').click(function(){
                $('.images-dropzone').toggleClass('d-none');
                $('.images-preview').toggleClass('d-none');
            })
        </script>
    @endpush
@endonce