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
            <label class="label-r" for="title">الجوال</label>
            {!! Form::text('mobile',null,['class'=>'form-control input-r','id'=>'mobile','placeholder'=>'رقم الجوال'])!!}
        </div>
        <!-- working days -->
        <div class="form-group col-5">
            <label for="worked_from">يبدأ العمل من يوم </label>
            <select id="worked_from" name='workday_from' class="form-control input-r">
                <option value="sat"  @if(isset($provider) && $provider->workday_from === 'sat') selected @endif>السبت</option>
                <option value="sun"  @if(isset($provider) && $provider->workday_from === 'sun') selected @endif>الاحد</option>
                <option value="mon"  @if(isset($provider) && $provider->workday_from === 'mon') selected @endif>الاثنين</option>
                <option value="tue"  @if(isset($provider) && $provider->workday_from === 'tue') selected @endif>الثلاثاء</option>
                <option value="wed"  @if(isset($provider) && $provider->workday_from === 'wed') selected @endif>الاربعاء</option>
                <option value="thu"  @if(isset($provider) && $provider->workday_from === 'thu') selected @endif>الخميس</option>
                <option value="fri"  @if(isset($provider) && $provider->workday_from === 'fri') selected @endif>الجمعة</option>

            </select>
            <br/>
            <label for="worked_to">ينتهى العمل فى يوم</label>
            <select id="worked_to" name='workday_to' class="form-control input-r">
                <option value="sat"  @if(isset($provider) && $provider->workday_to === 'sat') selected @endif>السبت</option>
                <option value="sun"  @if(isset($provider) && $provider->workday_to === 'sun') selected @endif>الاحد</option>
                <option value="mon"  @if(isset($provider) && $provider->workday_to === 'mon') selected @endif>الاثنين</option>
                <option value="tue"  @if(isset($provider) && $provider->workday_to === 'tue') selected @endif>الثلاثاء</option>
                <option value="wed"  @if(isset($provider) && $provider->workday_to === 'wed') selected @endif>الاربعاء</option>
                <option value="thu"  @if(isset($provider) && $provider->workday_to === 'thu') selected @endif>الخميس</option>
                <option value="fri"  @if(isset($provider) && $provider->workday_to === 'fri') selected @endif>الجمعة</option>
            </select>
        </div>
        <div class="form-group col-5">
            <label class="label-r" for="title"> القسم </label>
            {!! Form::select('cat_id',$categories,null,['class'=>'form-control input-r','id'=>'cat_id'])!!}
        </div>
        <div class="form-group col-5">
            <label class="label-r" for="title">رقم الرخصة التجارية</label>
            {!! Form::text('trading_license',null,['class'=>'form-control input-r','id'=>'trading_license','placeholder'=>'رقم الرخصة التجارية'])!!}
        </div>
    </div>  <div class="form-group m-form__group">
        <label>كلمه المرور</label>
        {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور'])!!}
    </div>
    <div class="form-group m-form__group">
        <label> تأكيد كلمه المرور </label>
        {!! Form::password('password_confirmation',['class'=>'form-control   m-input','placeholder'=>'ادخل تأكيد كلمه المرور'])!!}
    </div>
        <div class="form-group">
            <label class="label-r" for="title"> الصورة </label>
            {!! Form::file('image',null,['class'=>'form-control input-r','id'=>'image'])!!}
        </div>

        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
            <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
        </div>

    </div>
</div>
