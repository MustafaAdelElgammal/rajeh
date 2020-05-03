<div class="row">
    @csrf
    <div class="col-12">
        <div class="form-group col-5">
            <label class="label-r" for="title"> الاسم بالعربية </label>
            {!! Form::text('name',null,['class'=>'form-control input-r','id'=>'name','placeholder'=>'الاسم بالعربية'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> العنوان </label>
            {!! Form::text('address',null,['class'=>'form-control input-r','id'=>'address','placeholder'=>'العنوان'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> الجوال </label>
            {!! Form::text('mobile',null,['class'=>'form-control input-r','id'=>'mobile','placeholder'=>'الجوال'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> البلد </label>
            {!! Form::select('country_id',$countries,null,['class'=>'form-control input-r','id'=>'country_id'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> المدينة </label>
            {!! Form::select('city_id',$citys,null,['class'=>'form-control input-r','id'=>'city_id'])!!}
        </div>


{{--        <input type="text" name="mapSearch" id="mapSearch">--}}
{{--        <div id="map" style="height: 500px"></div>--}}
        <div class="form-group col-5">
            <label class="label-r" for="title">lat</label>
            {!! Form::text('lat',null,['class'=>'form-control input-r','id'=>'lat','placeholder'=>'lat'])!!}
        </div>
        <div class="form-group col-5">
            <label class="label-r" for="title">lng</label>
            {!! Form::text('lng',null,['class'=>'form-control input-r','id'=>'lng','placeholder'=>'lng'])!!}
        </div>
{{--        {!! Form::number('lat',null,['class'=>'form-control','id'=>'lat']) !!}--}}
{{--        {!! Form::number('lng',null,['class'=>'form-control','id'=>'lng']) !!}--}}
        <div class="form-group col-5">
            <label class="label-r" for="title">الرقم السرى</label>
            {!! Form::password('password',null,['class'=>'form-control input-r','id'=>'passsword','placeholder'=>'الرقم السرى'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title">اعادة كتابة الرقم السرى</label>
            {!! Form::password('re_password',null,['class'=>'form-control input-r','id'=>'re_passsword','placeholder'=>'الرقم السرى'])!!}
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
    @include('admin.clients._map')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $('[data-fancybox="images"]').fancybox({
            buttons: [
                'slideShow',
                'share',
                'zoom',
                'fullScreen',
                'close'
            ],
            thumbs: {
                autoStart: true
            }
        });
    </script>
@endsection
