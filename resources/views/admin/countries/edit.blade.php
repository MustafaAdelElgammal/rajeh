@extends('admin.layouts.master')
@section('title','تعديل الدولة')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل الدولة</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($country, ['method'=>'put','route'=>['countries.update',$country->id],'files'=>'true'])!!}
                    @include('admin.countries.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
