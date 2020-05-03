<div class="row">
    @csrf
        <div class="col-6">
            <div class="form-group ">
                <label class="label-r" for="title"> العنوان بالعربية </label>
                {!! Form::text('name_ar',null,['class'=>'form-control input-r','id'=>'name_ar','placeholder'=>'العنوان بالعربية'])!!}
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> العنوان بالانجليزية </label>
                {!! Form::text('name_en',null,['class'=>'form-control input-r','id'=>'name_en','placeholder'=>'العنوان بالانجليزية'])!!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> الوصف بالعربية </label>
                {!! Form::textarea('desc_ar',null,['class'=>'form-control input-r','id'=>'desc_ar','placeholder'=>'الوصف بالعربية'])!!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> الوصف بالانجليزية </label>
                {!! Form::textarea('desc_en',null,['class'=>'form-control input-r','id'=>'desc_en','placeholder'=>'الوصف بالانجليزية'])!!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> الصورة </label>
                {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="is_featured"> مميز </label>
                <input type="checkbox" id="is_featured" name="is_featured" @if(isset($category)&&!empty($category->id) && $category->is_featured == 1) checked  @endif>

{{--                {!! Form::checkbox('is_featured',1,['class'=>'form-control input-r','id'=>'is_featured','checked' => 'checked'])!!}--}}
            </div>
        </div>
        @if(isset($category)&&!empty($category->id))
            <input type="hidden" name="id" value="{{$category->id}}">
        @endif
        <div class="col-12">
            <div class="save-buttons">
                <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
                <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
            </div>
        </div>
    </div>

@section('more_scripts')
    <script>
        $('#is_featured').on('change', function(){
            this.value = this.checked ? 1 : 0;
            // alert(this.value);
        }).change();
    </script>
@endsection
