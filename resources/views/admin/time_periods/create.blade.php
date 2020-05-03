@extends('admin.layouts.master')
@section('title','اضافة اوقات عمل')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اضافة اوقات عمل</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'branch_period_time.store','files'=>'true'])!!}
                    @include('admin.time_periods.form')
                    {!!Form::close()!!}
                </div>

            </div>
        </div>
    </div>
@endsection

