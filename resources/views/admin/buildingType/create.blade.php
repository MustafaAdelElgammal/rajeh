@extends('admin.layouts.master')
@section('title','اضافة نوع جديد')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة نوع جديد</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'buildingType.store'])!!}
                    @include('admin.buildingType.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
