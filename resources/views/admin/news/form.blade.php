<div class="row">
    @csrf
    <div class="col-6">
        <div class="form-group ">
            <label class="label-r" for="title"> العنوان بالعربية </label>
            {!! Form::text('title_ar',null,['class'=>'form-control input-r','id'=>'title_ar','placeholder'=>'العنوان بالعربية'])!!}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label class="label-r" for="title"> العنوان بالانجليزية </label>
            {!! Form::text('title_en',null,['class'=>'form-control input-r','id'=>'title_en','placeholder'=>'العنوان بالانجليزية'])!!}
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="body_ar"> الخبر بالعربية </label>
                {!! Form::textarea('body_ar',null,['class'=>'form-control input-r','id'=>'body_ar','placeholder'=>'الخبر بالعربية'])!!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="body_en"> الخبر بالانجليزية </label>
                {!! Form::textarea('body_en',null,['class'=>'form-control input-r','id'=>'body_en','placeholder'=>'الخبر بالانجليزية'])!!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="label-r" for="title"> الصورة </label>
            {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
        </div>
        @if(isset($news)&&!empty($news->id))
            <input type="hidden" name="id" value="{{$news->id}}">
        @endif
        <div class="col-12">
            <div class="save-buttons">
                <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
                <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
            </div>
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

