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
            <label class="label-r" for="title"> سعر الباقة </label>
            {!! Form::text('price',null,['class'=>'form-control input-r','id'=>'price','placeholder'=>'السعر'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> مدة الباقة </label>
            {!! Form::text('period',null,['class'=>'form-control input-r','id'=>'price','placeholder'=>'المدة'])!!}
        </div>

        <div class="form-group col-5">
            <label for="type">نوع الباقة </label>
            <select id="type" name='type' class="form-control input-r">
                <option value="day" @if($package->type === 'day')  selected @endif>يومية</option>
                <option value="week" @if($package->type === 'week')  selected @endif>اسبوعية</option>
                <option value="month" @if($package->type === 'month')  selected @endif>شهرية</option>
                <option value="year" @if($package->type === 'year')  selected @endif>سنوية</option>
            </select>
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> التفاصيل بالعربية </label>
            {!! Form::textarea('desc_ar',null,['class'=>'form-control input-r','id'=>'desc_ar','placeholder'=>'التفاصيل بالعربية'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> التفاصيل بالانجليزية </label>
            {!! Form::textarea('desc_en',null,['class'=>'form-control input-r','id'=>'desc_en','placeholder'=>'التفاصيل بالانجليزية'])!!}
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
