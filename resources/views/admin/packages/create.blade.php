@extends('admin.layouts.master')
@section('title','باقات الدفع')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>باقات الدفع</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'packages.store', 'files'=>'true'])!!}
                    @include('admin.packages.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
