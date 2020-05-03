@extends('admin.layouts.master')
@section('title','اضافة منتج')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>المنتجات</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'products.store','files'=>'true'])!!}
                    @include('admin.products.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
