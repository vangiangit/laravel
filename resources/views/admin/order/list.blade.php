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
                                <th>Đơn hàng</th>
                                <th>Sàn</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thời gian đặt hàng</th>
                                <th>Mã đơn hàng FAST</th> 
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>#123456789</td>
                                    <td>
                                        Shopee
                                    </td>
                                    <td>
                                        3.200.000đ 
                                    </td>
                                    <td>
                                        Hoàn tất đơn hàng
                                    </td>
                                    <td>12:33, 11/03/2023 </td>
                                    <td>3064549505</td>
                                    <td class="text-center">
                                        <a href="{{route('admin-order-edit', ['id'=>$item->id])}}"><i class="far fa-edit"></i> Sửa</a>
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