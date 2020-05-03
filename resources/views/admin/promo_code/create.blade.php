@extends('admin.layouts.master')
@section('title','اضافة كود')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة كود</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'promo_code.store'])!!}
                    @include('admin.promo_code.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
