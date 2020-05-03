@extends('admin.layouts.master')
@section('title','اضافة معملات بنكية')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>المعاملات البنكية</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'post','route'=>'package_bank_transaction.store','files'=>'true'])!!}
                    @include('admin.package_bank_transaction.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
