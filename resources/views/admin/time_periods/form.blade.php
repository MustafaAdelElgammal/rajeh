<div class="row">
    @csrf
    <div class=" col-6">
        <div class="form-group">
            <div class="form-group">
                <label> التوقيت من الساعه</label>
                <input type="text" name="from" class="form-control datetimepicker-input"
                       id="timepicker" data-toggle="datetimepicker" data-target="#timepicker">
            </div>
        </div>
    </div>
    <div class=" col-6">
        <div class="form-group">
            <div class="form-group">
                <label> التوقيت الى الساعه</label>
                <input type="text" name="to" class="form-control datetimepicker-input"
                       id="timepickers" data-toggle="datetimepicker" data-target="#timepickers">
            </div>
        </div>
    </div>


    <div class="form-group col-6">
        <label class="label-r" for="title"> اختر مزود الخدمة </label>
        {!! Form::select('provider_id',\App\Models\Provider::pluck('name_ar','id'),null,['class'=>'form-control','id'=>'provider_id']) !!}
    </div>

    <div class="form-group col-6">
        <label class="label-r" for="title"> عنوان الفرع </label>
        {!! Form::select('provider_branch_id',\App\Models\ProviderBranch::pluck('address','id'),null,['class'=>'form-control','id'=>'provider_id']) !!}
    </div>
    <div class="form-group col-6">
        <label>الوصف بالعربية</label>
        {!! Form::textarea('desc_ar',null,['class'=>'form-control m-input','placeholder'=>'ادخل الوصف'])!!}
    </div>
    <div class="form-group col-6">
        <label>الوصف بالانجليزية</label>
        {!! Form::textarea('desc_en',null,['class'=>'form-control m-input','placeholder'=>'ادخل الوصف'])!!}
    </div>

    <div class="col-12">
        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
        </div>
    </div>
</div>
