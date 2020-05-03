@extends('admin.layouts.master')
@section('title','تعديل المنتج')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل المنتج</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($product, ['method'=>'put','route'=>['products.update',$product->id],'files'=>'true'])!!}
                     @include('admin.products.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
