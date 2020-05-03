@extends('admin.layouts.master')
@section('title','اضافة خدمة ثانوية')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة خدمة ثانوية</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'sub_services.store','files'=>'true'])!!}
                    @include('admin.sub_services.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
