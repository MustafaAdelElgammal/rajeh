@extends('admin.layouts.master')
@section('title','تعديل بيانات العميل')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل بيانات العميل</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($client, ['method'=>'put','route'=>['clients.update',$client->id],'files'=>'true'])!!}
                    @include('admin.clients.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
