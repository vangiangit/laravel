@extends('admin.layout.main')

@section('page-title')
    {{$title}}
@endsection

@section('module-title')
    {{$title}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng<br/>nhập kho</th>
                                <th>Số lượng<br/>cắt thực tế</th>
                                <th>Tình trạng</th>
                                <th>Tháng ra hàng<br/>dự kiến</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        {{$item->ten_san_pham}}
                                        <div>
                                            <span>BST:</span> {{$item->bst}}&nbsp;&nbsp;&nbsp;&nbsp;<span>Mã hàng:</span> {{$item->ma_hang}}
                                        </div>
                                    </td>
                                    <td>{{number_format($item->sl_nhap, 0, ',', '.')}}</td>
                                    <td>{{number_format($item->sl_cat_thuc_te, 0, ',', '.')}}</td>
                                    <td>{{$item->tinh_trang_san_xuat}}</td>
                                    <td>{{date('d/m/Y', strtotime($item->thang_ra_ch))}}</td>
                                    <td>{{$item->tinh_trang_npl}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin-product-edit', ['id'=>$item->id])}}"><i class="far fa-edit"></i> Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
