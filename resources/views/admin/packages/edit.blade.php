@extends('admin.layouts.master')
@section('title','تعديل الباقات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل الباقات</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($package, ['method'=>'put','route'=>['packages.update',$package->id],'files'=>'true'])!!}
                    @include('admin.packages.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
