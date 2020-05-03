@extends('admin.layouts.master')
@section('title','اوقات العمل')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>اوقات عمل الفروع</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($time_period, ['method'=>'put','route'=>['branch_period_time.update',$time_period->id],'files'=>'true'])!!}
                     @include('admin.time_periods.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
