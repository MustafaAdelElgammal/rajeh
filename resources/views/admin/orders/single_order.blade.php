@extends('admin.layouts.master')
@section('title','الطلبات')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php //$spec = \App\Models\Specialization::where('id',$order->specialization_id)->select('name')->withTrashed()->first();?>
                </div>
                <div class="card-body">
                    <div class="dt-responsive">
                        <table id="scr-vtr-dynamic" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th style="text-align: center;">مقدم الخدمة</th>
                                <th style="text-align: center;">الوصف</th>
                                <th style="text-align: center;">تاريخ الاستلام المتوقع</th>
                                <th style="text-align: center;">الحالة</th>
                                <th style="text-align: center;" >السعر</th>
                                <!-- <th>الحجم</th> -->
                                <th style="text-align: center;"> الضريبة</th>
                                <th style="text-align: center;">العنوان</th>
                                <th style="text-align: center;">تم الدفع</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="text-align: center;">{{$order->provider->name_ar}}</td>
                                <td style="width:35%;text-align: center; width:35%">{!! substr($order->desc,1,50) !!}</td>
                                <td style="text-align: center;"> {{$order->time_period_id}}</td>
                                <td style="text-align: center;" >{{($order->status == 'new') ? 'جديد' : ($order->status == 'working' ? 'يتم العمل عليه': ($order->status == 'canceled' ? 'تم رفضه': 'تم بنجاح'))}}</td>
                                <td style="text-align: center;"> {{$order->price}}</td>
                                <td style="text-align: center;"> {{$order->tax}}</td>
                                <td style="text-align: center;"> {{$order->address}}</td>
                                <td style="text-align: center;"> {{$order->payment_type}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
            {{--Comments Start--}}
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
                        <div class="card-body chat-box scrollable" style="height:300px;overflow: auto;">
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
                                    <input name="to_id" value="{{$order->provider->id}}" type="hidden">
                                    <input name="order_id" value="{{$order->id}}" type="hidden">
                                </div>
                                <button type="submit" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--Comments End--}}

            {{--Actions Start--}}
{{--            <div class="col-lg-4 col-md-5">--}}
{{--                <div class="card">--}}
{{--                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Actions</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content" id="pills-tabContent">--}}
{{--                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="m-0 p-0">--}}
{{--                                    <div class="row col-12">--}}
{{--                                        @if($order->status == 'new')--}}
{{--                                        <form id="acceptForm" action="{{route('orders.update',$order->id)}}" method="post">--}}
{{--                                                @method("PATCH")--}}
{{--                                                @csrf--}}
{{--                                                <input name="value" type="hidden" value="working">--}}
{{--                                            </form>--}}
{{--                                        <a href="javascript:$('#acceptForm').submit();" class="col-5 btn btn-block btn-success" data-toggle="tooltip" data-placement="top" title="Accept"><i class="fa fa-check"></i></a>--}}
{{--                                        @endif--}}
{{--                                        @if($order->status == 'working' || $order->status == 'new')--}}
{{--                                            <a onclick="Cancel({{$order->id}})" href="javascript:void(0);" class="col-5 btn btn-block btn-danger m-0 ml-2"  data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-times"></i></a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <div class="sl-item">--}}
{{--                                        {!! Form::model($order, ['method'=>'put','route'=>['orders.update',$order->id],'files'=>'true'])!!}--}}
{{--                                        <label for="price">--}}
{{--                                            Add Price:--}}
{{--                                        </label>--}}
{{--                                        {!! Form::number('price',null,['class'=>'form-control input-r','id'=>'price','placeholder'=>'Price'])!!}--}}
{{--                                        <label for="due_date">--}}
{{--                                            Due Date:--}}
{{--                                        </label>--}}
{{--                                        {!! Form::text('due_date',null,['class'=>'form-control input-r sh3ban','id'=>'due_date','placeholder'=>'0000-00-00'])!!}--}}
{{--                                        {!! Form::date('due_date',null,['class'=>'form-control input-r','id'=>'due_date','placeholder'=>'due_date'])!!}--}}
{{--                                        <button   type="submit" class="btn btn-success">Add</button>--}}
{{--                                        {!!Form::close()!!}--}}
{{--                                        <div class="panel-body">--}}
{{--                                            <br />--}}

{{--                                            <form method="post" action="{{ route('search.upload',$order->id) }}" enctype="multipart/form-data" id="searchUpload">--}}
{{--                                                @csrf--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <input type="file" name="search" id="file" />--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <input type="submit" name="upload" value="Upload" class="btn btn-success" />--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                            <br />--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" aria-valuenow=""--}}
{{--                                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%">--}}
{{--                                                    0%--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <br />--}}
{{--                                            <div id="success">--}}
{{--                                                @if($order->search != null)--}}
{{--                                                    <a href="{{asset($order->search)}}" download><i class="fa fa-download"></i>  تحميل البحث  </a>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <br />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
            {{--Actions End--}}
{{--                <div class="col-lg-8 col-md-7">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <h4>Attachments</h4>--}}
{{--                            <table id="advanced_table" class="table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}

{{--                                    <th>Attachments</th>--}}
{{--                                    <th>View</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

{{--                                </tbody>--}}
{{--                            </table>--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
@section('more_scripts')
    <script>


        function Cancel(id){
            Swal.mixin({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel it!',
                progressSteps: ['1', '2']
            }).queue([
                {
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Cancel it!',
                },
                {
                    input: 'textarea',
                    inputPlaceholder:'Reject Reason' ,
                    title: 'Reject Reason',
                    confirmButtonText: 'Yes, Cancel it!',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'please fill reject reason'
                        }
                    }
                },
            ]).then((result) => {
                if (result.value) {
                    var url = "{{route('orders.update',['id'=>''])}}/" + id;
                    $.ajax({
                        url: url,
                        type: 'PATCH',
                        data: {"_token": "{{ csrf_token() }}","reject_reason":result.value},
                        success: function (data) {
                            if(data === "true"){
                                Swal.fire({
                                    type: 'success',
                                    title: 'نجاح',
                                    text: 'تم الرفض بنجاح',
                                    showCancelButton: false,
                                    confirmButtonColor: '#0e99ff',
                                });
                                //alert ("Issue is deleted");
                            }else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'خطأ!',
                                    text: 'حدث خطأ أثناء الرفض',
                                    showCancelButton: false,
                                    confirmButtonColor: '#d33',
                                });
                                //alert ("something wrong");
                                return false;
                            }
                        }
                    });
                }
            })
        }
        $(document).ready(function(){

            $('#searchUpload').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger" dir="rtl"><b>'+'@if ($errors->any()) @foreach ($errors->all() as $error) {{ $error }} @endforeach @endif'+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                        $('#success').append(data.image);
                    }
                }
            });

        });
    </script>

@endsection
