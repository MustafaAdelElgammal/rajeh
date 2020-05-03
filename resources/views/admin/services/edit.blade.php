@extends('admin.layouts.master')
@section('title','تعديل بيانات الخدمات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل بيانات الخدمات</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($service, ['method'=>'put','route'=>['services.update',$service->id],'files'=>'true'])!!}
                     @include('admin.services.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
