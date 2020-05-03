@extends('admin.layouts.master')
@section('title','المدن')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>المدن</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'cities.store'])!!}
                    @include('admin.cities.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
