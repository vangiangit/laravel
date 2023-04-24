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
            <div class="mb-3 row d-none">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-2">

                </div>
                <div class="col-lg-2">

                </div>
                <div class="col-lg-2">

                </div>
                <div class="col-lg-2">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>BST</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng<br/>thực tế</th>
                                <th>Trạng thái</th>
                                <th>Tình trạng</th>
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
                                            <span>Mã lệnh sản xuất:</span> {{$item->ma_hang}}
                                        </div>
                                    </td>
                                    <td>{{$item->bst}}</td>
                                    <td>
                                        @if(!empty($item->images) && isset($item->images[0]))
                                            <img style="width: 75px;" src="{{ str_replace('/original/', '/original/', Storage::disk('public_uploads')->url('') . '/' . $item->images[0]->path)}}" />                                            
                                        @endif
                                    </td>
                                    <td>{{number_format($item->sl_cat_thuc_te, 0, ',', '.')}}</td>
                                    <td>{{$item->tinh_trang_npl}}</td>
                                    <td>{{$item->tinh_trang_san_xuat}}</td>
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
