@extends('admin.layouts.master')
@section('title','تعديل بيانات الفروع')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل بيانات الفروع</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($providerBranch, ['method'=>'put','route'=>['providers_branches.update',$providerBranch->id]])!!}
                     @include('admin.providers_branches.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
