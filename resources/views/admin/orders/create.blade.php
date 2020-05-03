@extends('admin.layouts.master')
@section('title','اضافة طلب')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>العملاء</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'orders.store'])!!}
                    @include('admin.orders.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
