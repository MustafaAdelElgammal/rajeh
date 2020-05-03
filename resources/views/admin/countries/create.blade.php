@extends('admin.layouts.master')
@section('title','الدول')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>دولة جديدة</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'countries.store'])!!}
                    @include('admin.countries.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
