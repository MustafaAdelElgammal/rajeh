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

        <div class="form-group col-5">
            <label class="label-r" for="title"> كود الدفع </label>
            {!! Form::select('promocode_id',$promo_codes,null,['class'=>'form-control input-r','id'=>'promocode_id'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> الدفع </label>
            {!! Form::select('payment_id',$payments,null,['class'=>'form-control input-r','id'=>'payment_id'])!!}
        </div>


        <div class="form-group col-5">
            <label for="payment_type">طريقة الدفع </label>
            <select id="payment_type" name='payment_type' class="form-control input-r">
                <option value="cash" @if(!empty($payment_type) && $payment_type == 'cash')  selected @endif>كاش </option>
                <option value="online" @if(!empty($payment_type) && $payment_type == 'online')  selected @endif> عبر الانترنت </option>
            </select>
        </div>

            <div class="col-12">
                <div class="save-buttons">
                    <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
                    <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
                </div>
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
