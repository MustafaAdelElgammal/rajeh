@extends('admin.layouts.master')
@section('title','المديرين')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>اضافة مدير </h3></div>
            <div class="card-body">
                {!! Form::open(['method'=>'post','route'=>'users.store','files'=>'true'])!!}
                    @include('admin.users.form')
                {!!Form::close()!!}
            </div>
        </div>
    </div>


</div>
@endsection
