<div class="row">
    @csrf
    <div class="col-12">

        <div class="form-group col-5">
            <label class="label-r" for="title"> اختر مقدم الخدمة </label>
            {!! Form::select('provider_id',$providers,null,['class'=>'form-control input-r','id'=>'provider_id'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> نوع الباقة </label>
            {!! Form::select('package_id',$packages,null,['class'=>'form-control input-r','id'=>'package_id'])!!}
        </div>
        <div class="col-6">

            <div class="form-group">
                <label class="label-r" for="title"> ملاحظات </label>
                {!! Form::textarea('notes',null,['class'=>'form-control input-r','id'=>'notes','placeholder'=>'ملاحظات'])!!}
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="label-r" for="title"> الصورة </label>
                {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
            </div>
        </div>

        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
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
