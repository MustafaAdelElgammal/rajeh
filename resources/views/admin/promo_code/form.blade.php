<div class="row">
    @csrf
    <div class="col-12">
        <div class="form-group col-5">
            <label class="label-r" for="title"> رقم الكود </label>
            {!! Form::text('code',null,['class'=>'form-control input-r','id'=>'code','placeholder'=>'رقم الكود'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> يبدأ العمل به فى : </label>
            {!! Form::date('activate_at',null,['class'=>'form-control input-r','id'=>'activate_at'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> ينتهى فى : </label>
            {!! Form::date('expired_at',null,['class'=>'form-control input-r','id'=>'expired_at'])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> المرات المتاحة للاستخدام </label>
            {!! Form::number('amount',null,['class'=>'form-control input-r','id'=>'amount','placeholder'=>'عدد مرات الاستخدام ', 'pattern'=>"/[0-9]|\./"])!!}
        </div>

        <div class="form-group col-5">
            <label class="label-r" for="title"> عدد مرات الاستخدام  </label>
            {!! Form::number('used_number',null,['class'=>'form-control input-r','id'=>'amount','placeholder'=>'عدد مرات الاستخدام ', 'pattern'=>"/[0-9]|\./"])!!}
        </div>

        <div class="save-buttons">
            <button type="submit" class="btn btn-primary btn-lg">حفظ</button>
            <a class="btn btn-light btn-lg" href="{{ URL::previous() }}">العودة</a>
        </div>

    </div>
</div>
