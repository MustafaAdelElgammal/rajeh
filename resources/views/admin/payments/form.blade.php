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
            <label class="label-r" for="amount"> الكمية </label>
            {!! Form::text('amount',null,['class'=>'form-control input-r','id'=>'price','placeholder'=>'الكمية'])!!}
        </div>
        <div class="form-group col-5">
            <label for="status">نوع الباقة </label>
            <select id="status" name='status' class="form-control input-r">
                <option value="pending" @if(!empty($payment) && $payment->status == 'pending')  selected @endif>انتظار </option>
                <option value="paid" @if(!empty($payment) && $payment->status == 'paid')  selected @endif> مدفوعة </option>
                <option value="unpaid" @if(!empty($payment) && $payment->status == 'unpaid')  selected @endif> غير مدفوعة </option>
            </select>
        </div>

        <div class="form-group col-5">
            <label for="type">نوع الباقة </label>
            <select id="type" name='type' class="form-control input-r">
                <option value="payment" @if(!empty($payment) && $payment->type === 'payment')  selected @endif>مدفوعة</option>
                <option value="refund" @if(!empty($payment) && $payment->type === 'refund')  selected @endif>مسترجع</option>
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
