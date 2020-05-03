@extends('admin.layouts.master')
@section('title','تعديل النوع')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل النوع</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($buildingType, ['method'=>'put','route'=>['buildingType.update',$buildingType->id],'files'=>'true'])!!}
                    @include('admin.buildingType.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
