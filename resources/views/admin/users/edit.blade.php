@extends('admin.layouts.master')
@section('title','المديرين')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3>تعديل مدير</h3></div>
            <div class="card-body">
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch','files'=>'true']) !!}
                    @include('admin.users.form')
                {!! Form::close() !!}

            </div>
        </div>
    </div>


</div>

@endsection
