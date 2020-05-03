@extends('admin.layouts.master')
@section('title','اضافة مزود خدمة')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>إضافة مزود خدمة</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'providers.store', 'files'=>'true'])!!}
                    @include('admin.providers.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
