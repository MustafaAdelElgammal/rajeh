@extends('admin.layouts.master')
@section('title','الاعدادات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Settings</h3>
                </div>
                <div class="card-body">
                    @include('admin.settings.table')
                </div>
            </div>
        </div>
    </div>
@endsection
