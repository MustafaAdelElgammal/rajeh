<div class="row">
    @csrf
    <div class="col-12">
        <div class="col-12">
            <div class="form-group">
                <label class="label-r" for="cname"> اسم الإعداد </label>
                {!! Form::text('name',null,['class'=>'form-control input-r','id'=>'cname','placeholder'=>'اسم الإعداد','disabled'=>'true'])!!}
            </div>
            <div class="form-group">
                <label class="label-r" for="cvalue_ar"> قيمة الإعداد باللغة العربية </label>
                {!! Form::textarea('value_ar',null,['class'=>'form-control textarea-r','id'=>'cvalue_ar','placeholder'=>'قيمة الإعداد باللغة العربية'])!!}
            </div>
            <div class="form-group">
                <label class="label-r" for="cvalue_en"> قيمة الإعداد باللغة الإنجليزية </label>
                {!! Form::textarea('value_en',null,['class'=>'form-control textarea-r','id'=>'cvalue_en','placeholder'=>'قيمة الإعداد باللغة الإنجليزية'])!!}
            </div>
        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
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

