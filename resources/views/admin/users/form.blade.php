<form class="forms-sample">
    <div class="form-group">
        <label for="name">الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        {!! Form::email('email',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        <label for="password">كلمة المرور</label>
        {!! Form::password('password', ['class' => 'form-control' ,'placeholder'=>'كلمة المرور يجب أن تكون على الأقل 8 رموز']) !!}
    </div>
    <div class="form-group">
        <label for="password_confirmation">تأكيد كلمة المرور</label>
        {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'يجب ان تطابق تأكيد كلمة المرور مع كلمة المرور']) !!}
    </div>
    @if(isset($user))
        <input type="hidden" value="{{$user->id}}" name="id">
    @endif
    <div class="col-6">
        <div class="form-group">
            <label class="label-r" for="title"> الصورة </label>
            {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
        </div>
    </div>
    <div class="col-12">
        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
            <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
        </div>
    </div>
</form>
@section('more_scripts')
    @if ($errors->any())
        <script>
            $( document ).ready(function() {
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

