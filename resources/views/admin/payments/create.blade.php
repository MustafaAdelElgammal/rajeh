@extends('admin.layouts.master')
@section('title','الشيكات')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>الشيكات</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'payments.store'])!!}
                    @include('admin.payments.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
