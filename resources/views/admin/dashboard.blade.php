@extends('admin.layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <img src="{{asset('statics/admin/img/user-sixdo.png')}}">
                    <p>{{Auth::user()->name}}</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box">
                <div class="inner">
                    <img src="{{asset('statics/admin/img/T-Shirt.png')}}">
                    <p>QUẢN LÝ MẪU SẢN PHẨM</p>
                    <a href="{{route('admin-product-list')}}"><i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
