@extends('admin.layouts.master')
@section('title','اضافة خدمة ')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة خدمة </h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'services.store','files'=>'true'])!!}
                    @include('admin.services.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
