@extends('admin.layouts.master')
@section('title','اضافة عميل')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة عميل</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'clients.store', 'files'=>'true'])!!}
                    @include('admin.clients.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
