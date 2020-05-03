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

        <div class="form-group col-5">
            <label class="label-r" for="title"> التفاصيل بالعربية </label>
            {!! Form::textarea('desc_ar',null,['class'=>'form-control input-r','id'=>'desc_ar','placeholder'=>'التفاصيل بالعربية'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> التفاصيل بالانجليزية </label>
            {!! Form::textarea('desc_en',null,['class'=>'form-control input-r','id'=>'desc_en','placeholder'=>'التفاصيل بالانجليزية'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> القسم </label>
            {!! Form::select('cat_id',$categories,null,['class'=>'form-control input-r','id'=>'cat_id','placeholder'=>'- اختر القسم -'])!!}
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_featured"  name="is_featured" @if(isset($service )&& $service->is_featured === 1) checked @endif>
            <label class="form-check-label" for="is_featured">مصنف</label>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> الصورة </label>
                {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
            </div>
        </div>
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
