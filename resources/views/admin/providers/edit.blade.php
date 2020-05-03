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
                    {!! Form::model($provider, ['method'=>'put','route'=>['providers.update',$provider->id],'files'=>'true'])!!}
                     @include('admin.providers.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
