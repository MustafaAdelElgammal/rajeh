@extends('admin.layouts.master')
@section('title','اضافة خبر جديد')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3>اضافة خبر جديد</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'news.store','files'=>'true'])!!}
                    @include('admin.news.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
