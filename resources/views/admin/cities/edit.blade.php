@extends('admin.layouts.master')
@section('title','تعديل المدينة')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل المدينة</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($city, ['method'=>'put','route'=>['cities.update',$city->id],'files'=>'true'])!!}
                    @include('admin.cities.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
