@extends('admin.layouts.master')
@section('title','اضافة قسم جديد')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3>اضافة قسم جديد</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'categroies.store','files'=>'true'])!!}
                    @include('admin.categroies.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
