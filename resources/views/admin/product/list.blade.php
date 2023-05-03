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
            <form id="frm-admin-product" name="frm-admin-product" action="{{route('admin-product-list')}}" method="GET">
                <div class="mb-3 mt-3 row">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-3">
                                <input value="{{Request::get('keyword')}}" type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Từ khóa">
                            </div>
                            <div class="col-lg-3">
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="">Tình trạng</option>
                                    <option value="Đang sản xuất">Đang sản xuất</option>
                                    <option value="Đã nhập kho">Đã nhập kho</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-2"><label>Từ</label></div>
                                    <div class="col-lg-10">
                                        <div class="input-group date reservationdate" id="reservationdate_start" data-target-input="nearest">
                                            <input value="{{Request::get('date_start')}}" name="date_start" type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdate_start">
                                            <div class="input-group-append" data-target="#reservationdate_start" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-2"><label>Đến</label></div>
                                    <div class="col-lg-10">
                                        <div class="input-group date reservationdate" id="reservationdate_end" data-target-input="nearest">
                                            <input value="{{Request::get('date_end')}}" name="date_end" type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdate_end">
                                            <div class="input-group-append" data-target="#reservationdate_end" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-success form-control form-control-sm btn-sm" type="submit">
                                    Tìm kiếm
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-export btn-danger form-control form-control-sm btn-sm" type="button">
                                    Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                                    <td>{{ $loop->iteration }}</td>
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

@once
    @push('custom_style_header')
        <link rel="stylesheet" href="{{asset('statics/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}?v=1">
    @endpush

    @push('custom_script_footer')
        <script src="{{asset('statics/plugins/moment/moment.min.js')}}?v=1"></script>
        <script src="{{asset('statics/plugins/inputmask/jquery.inputmask.min.js')}}?v=1"></script>
        <script src="{{asset('statics/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}?v=1"></script>
        <script>
            $('.content-header').toggleClass('d-none');
            $(document).ready(function(){
                $('#reservationdate_start').datetimepicker({
                    format: 'L'
                });
                $('#reservationdate_end').datetimepicker({
                    format: 'L'
                });
            });
            $('.btn-export').click(function(){
                $('#frm-admin-product').attr('action', "{{route('admin-product-export')}}");
                document.getElementById("frm-admin-product").submit();
                $('#frm-admin-product').attr('action', "{{route('admin-product-list')}}");
            });
        </script>
    @endpush
@endonce