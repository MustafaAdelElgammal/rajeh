@extends('admin.layouts.master')
@section('title','تعديل المنتج')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل المنتج</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($transaction, ['method'=>'put','route'=>['package_bank_transaction.update',$transaction->id],'files'=>'true'])!!}
                     @include('admin.package_bank_transaction.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
