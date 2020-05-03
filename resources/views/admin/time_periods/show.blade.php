@extends('admin.layouts.master')
@section('title','مواعيد تشغيل الفروع')
@section('content')

    {!! Form::open(['method'=>'post','route'=>'branch_period_time.store'])!!}
    @include('admin.time_periods.form')
    {!!Form::close()!!}
    <br />
    @include('admin.time_periods.table')
@endsection
