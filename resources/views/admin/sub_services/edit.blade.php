@extends('admin.layouts.master')
@section('title','تعديل بيانات مزود الخدمات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل بيانات مزود الخدمات</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($sub_service, ['method'=>'put','route'=>['sub_services.update',$sub_service->id],'files'=>'true'])!!}
                     @include('admin.sub_services.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
