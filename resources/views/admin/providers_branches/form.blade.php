<div class="row">
    @csrf
    <div class="col-12">
        <div class="form-group col-5">
            <label class="label-r" for="title"> العنوان </label>
            {!! Form::text('address',null,['class'=>'form-control input-r','id'=>'name_ar','placeholder'=>'العنوان'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> الجوال </label>
            {!! Form::text('mobile',null,['class'=>'form-control input-r','id'=>'mobile','placeholder'=>'الجوال'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> اختر الموزع </label>
            {!! Form::select('provider_id',$providers,null,['class'=>'form-control input-r','id'=>'provider_id','placeholder'=>'اختر الموزع'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> اختر البلد </label>
            {!! Form::select('country_id',$countries,null,['class'=>'form-control input-r','id'=>'country_id','placeholder'=>'اختر البلد'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> اختر المدينة </label>
            {!! Form::select('city_id',$cities,null,['class'=>'form-control input-r','id'=>'city_id','placeholder'=>'اختر المدينة'])!!}
        </div>
        <div class="form-group col-5">
            <label class="label-r" for="title">lat</label>
            {!! Form::text('lat',null,['class'=>'form-control input-r','id'=>'lat','placeholder'=>'lat'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title">lng</label>
            {!! Form::text('lng',null,['class'=>'form-control input-r','id'=>'lng','placeholder'=>'lng'])!!}
        </div>


        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
            <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>

        </div>
    </div>
</div>


