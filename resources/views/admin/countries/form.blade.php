<div class="row">
    @csrf
    <div class="col-12">
        <div class="form-group col-5">
            <label class="label-r" for="title"> الاسم بالعربية </label>
            {!! Form::text('name_ar',null,['class'=>'form-control input-r','id'=>'name_ar','placeholder'=>'الاسم بالعربية'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> الاسم بالانجليزية </label>
            {!! Form::text('name_en',null,['class'=>'form-control input-r','id'=>'name_en','placeholder'=>'الاسم بالانجليزية'])!!}
        </div>
    </div>
    <div class="col-12">
        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
            <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
        </div>
    </div>
</div>
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