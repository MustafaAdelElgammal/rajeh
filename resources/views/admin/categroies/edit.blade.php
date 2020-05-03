@extends('admin.layouts.master')
@section('title','تعديل الخبر')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل الخبر</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($category, ['method'=>'put','route'=>['categroies.update',$category->id],'files'=>'true'])!!}
                    @include('admin.categroies.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
