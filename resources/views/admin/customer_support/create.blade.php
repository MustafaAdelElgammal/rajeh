@extends('admin.layouts.master')
@section('title','رسالة جديدة')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>رسالة جديدة</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'customer-support.store'])!!}
                    @include('admin.customer_support.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
