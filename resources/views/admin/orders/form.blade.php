<div class="row">
    @csrf
    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> مقدم الخدمة </label>
            {!! Form::select('client_id',\App\Models\Client::pluck('name','id'),null,['class'=>'form-control input-r','id'=>'client_id'])!!}
        </div>
    </div>
    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> مقدم الخدمة </label>
            {!! Form::select('provider_id',\App\Models\Provider::pluck('name_ar','id'),null,['class'=>'form-control input-r','id'=>'provider_id'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> الخدمة </label>
            {!! Form::select('sub_service_id',$sub_services,null,['class'=>'form-control input-r','id'=>'sub_service_id'])!!}
        </div>
    </div>
    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> نوع المنتج </label>
            {!! Form::select('product_id',$products,null,['class'=>'form-control input-r','id'=>'product_id'])!!}
        </div>
    </div>


    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> وقت العمل </label>
            {!! Form::select('time_period_id',$time_periods,null,['class'=>'form-control input-r','id'=>'time_period_id'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="building_type_id"> نوع المبنى </label>
            {!! Form::select('building_type_id',$building_types,null,['class'=>'form-control input-r','id'=>'building_type_id'])!!}
        </div>
    </div>
    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> طريقة الدفع </label>
            {!! Form::text('payment_type',null,['class'=>'form-control input-r','id'=>'payment_type','placeholder'=>'طريقة الدفع'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> السعر </label>
            {!! Form::text('price',null,['class'=>'form-control input-r','id'=>'price','placeholder'=>'السعر'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> العنوان </label>
            {!! Form::text('address',null,['class'=>'form-control input-r','id'=>'address','placeholder'=>'العنوان'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title"> خدمة التوصيل </label>
            {!! Form::text('delivery',null,['class'=>'form-control input-r','id'=>'delivery','placeholder'=>'خدمة التوصيل'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="title">الضريبة المضافة</label>
            {!! Form::text('tax',null,['class'=>'form-control input-r','id'=>'tax','placeholder'=>'الضريبة المضافة'])!!}
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="status">الحالة</label>
            <select id="status" name='status' class="form-control input-r">
                <option value="new"> جديدة</option>
                <option value="priced"> مدفوعة</option>
                <option value="accepted"> تم القبول</option>
                <option value="working">مشغولة</option>
                <option value="done">تمت</option>
                <option value="rejected"> مرفوضة</option>
                <option value="canceled"> ملغية</option>

            </select>
        </div>
    </div>

    <div class=" col-6">
        <div class="form-group">
            <label class="label-r" for="reject_reason"> اسباب رفض الطلب </label>
            {!! Form::textarea('desc',null,['class'=>'form-control input-r','id'=>'tax','placeholder'=>'اسباب رفض الطلب '])!!}
        </div>
    </div>

    <div class=" col-5">
        <div class="form-group">
            <label class="label-r" for="lat"> lat </label>
            {!! Form::text('lat',null,['class'=>'form-control input-r','id'=>'lat','placeholder'=>'lat '])!!}
        </div>
    </div>
    <div class=" col-5">
        <div class="form-group">
            <label class="label-r" for="lat"> lng </label>
            {!! Form::text('lng',null,['class'=>'form-control input-r','id'=>'lng','placeholder'=>'lng '])!!}
        </div>
    </div>

    <div class="col-12">
        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
        </div>
    </div>
</div>

@section('more_scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function () {
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
