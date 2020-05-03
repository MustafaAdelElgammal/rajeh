@extends('admin.layouts.master')
@section('title','عرض المعاملات البنكية')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>عرض المعاملات البنكية</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="col-12">

                            <div class="form-group col-5">
                                <label class="label-r" for="title"> مقدم الخدمة :  </label>
                                <div>{{$transaction->provider->name_ar}}</div>
                            </div>

                            <div class="form-group col-5">
                                <label class="label-r" for="title"> نوع الباقة :  </label>
                                <div>{{$transaction->package->name_ar}}</div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label class="label-r" for="title"> ملاحظات </label>
                                    {!! Form::textarea('notes',$transaction->notes,['class'=>'form-control input-r','id'=>'notes','placeholder'=>'ملاحظات', 'readonly'=>'true'])!!}
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <a href="{{asset($transaction->image)}}" trarger="_blank"><img src="{{asset($transaction->image)}}"
                                                                                           class="table-user-thumb"
                                                                                           alt="{{$transaction->name}}"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                    {!! Form::model($transaction, ['method'=>'put','route'=>['package_bank_transaction.update',$transaction->id],'files'=>'true'])!!}--}}
{{--                    @include('admin.package_bank_transaction.form')--}}
{{--                    {!!Form::close()!!}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
