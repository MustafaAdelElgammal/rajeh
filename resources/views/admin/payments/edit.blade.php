@extends('admin.layouts.master')
@section('title','تعديل المدينة')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل المدينة</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($payment, ['method'=>'put','route'=>['payments.update',$payment->id]])!!}
                    @include('admin.payments.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
