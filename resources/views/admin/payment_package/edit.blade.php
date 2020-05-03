@extends('admin.layouts.master')
@section('title','تعديل باقة الدفع')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل باقة الدفع</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($packagePayment, ['method'=>'put','route'=>['payment-packages.update',$packagePayment->id]])!!}
                    @include('admin.payment_package.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
