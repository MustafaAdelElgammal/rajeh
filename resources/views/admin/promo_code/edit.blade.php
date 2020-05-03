@extends('admin.layouts.master')
@section('title','تعديل بيانات مزود الخدمات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل بيانات مزود الخدمات</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($promo_code, ['method'=>'put','route'=>['promo_code.update',$promo_code->id]])!!}
                     @include('admin.promo_code.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
