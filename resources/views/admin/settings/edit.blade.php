@extends('admin.layouts.master')
@section('title','تعديل الإعدادات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل الإعدادات</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($setting, ['method'=>'put','route'=>['settings.update',$setting->id],'files'=>'true'])!!}
                        @include('admin.settings.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
