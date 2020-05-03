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
                    {!! Form::model($order, ['method'=>'put','route'=>['orders.update',$order->id]])!!}
                     @include('admin.orders.form')
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="col-lg-8 col-md-7">
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h3>Recent Chat</h3>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="ik ik-chevron-left action-toggle"></i></li>
                        <li><i class="ik ik-minus minimize-card"></i></li>
                        <li><i class="ik ik-x close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body chat-box scrollable" style="height:300px;">
                <ul class="chat-list">
                    @foreach($comments as $comment)
                        <li class="chat-item {{($comment->from_id == Auth::id()) ? 'odd' : '' }}">
                            <div class="chat-content">
                                @if($comment->from_id == Auth::id())
                                @else
                                    <h6 class="font-medium">{{(isset($comment->client_from->name))?$comment->client_from->name:''}}</h6>
                                @endif
                                <div class="box bg-light-info">{{$comment->message}}</div>
                            </div>
                            @if($comment->from_id == Auth::id())
                            @else
                                <div class="chat-time">{{$comment->created_at}}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer chat-footer">
                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    <div class="input-wrap">
                        <input name="message" type="text" placeholder="Type and enter" class="form-control">
                        <input name="to_id" value="{{$order->user_id}}" type="hidden">
                        <input name="order_id" value="{{$order->id}}" type="hidden">
                    </div>
                    <button type="submit" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
