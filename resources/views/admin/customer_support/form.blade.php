<div class="row">
    @csrf
    <div class=" col-6">
        <div class="form-group">
{{--            <label class="label-r" for="title"> الى </label>--}}
{{--            {!! Form::select('to_id',$users,null,['class'=>'form-control input-r','id'=>'to_id'])!!}--}}
        </div>
    </div>
</div>
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

                </ul>
            </div>
            <div class="card-footer chat-footer">
                <form action="{{route('customer-support.store')}}" method="post">
                    @csrf
                    <label class="label-r" for="title"> الى </label>
                    {!! Form::select('to_id',$clients,null,['class'=>'form-control input-r','id'=>'to_id'])!!}

{{--                    <select name="" id="">--}}
{{--                        @foreach()--}}
{{--                        <option value=""></option>--}}
{{--                            @endforeach--}}
{{--                    </select>--}}
{{--                    <input type="text" name="to_id" value="{{$comments->to_id}}">--}}
                    <div class="input-wrap">
                        <input name="message" type="text" placeholder="Type and enter" class="form-control">

                        @if(empty($comments))

                            <input name="idaa" type="hidden" value="{{$comments}}">
                            <input type="hidden" name="parent_id" value="{{$comments->to_id }}">
                            <input type="hidden" name="to_id" value="{{ $comments->to_id}}">
                        @endif
                        <input type="hidden" name="from_id" value="{{ Auth::id() }}">

                        {{--                    @if()--}}
                        {{--                        <input type="hidden" name="to_id" value="{{ $comments->to_id}}">--}}
                        {{--                         @endif--}}
                    </div>
                    <button type="submit" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('more_scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                Swal.fire(
                    'يوجد خطأ',
                    '@foreach ($errors->all() as $error)\n' +
                    '{{ $error }}<br/>\n' +
                    '@endforeach',
                    'error'
                )
            });
        </script>
    @endif
@endsection
