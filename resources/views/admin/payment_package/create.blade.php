@extends('admin.layouts.master')
@section('title','اضافة باقة مدفوعة')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة باقة مدفوعة</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'payment-packages.store'])!!}
                    @include('admin.payment_package.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
