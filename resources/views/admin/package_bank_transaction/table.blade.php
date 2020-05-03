<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">صورة</th>
        <th class="nosort">الباقة</th>
        <th class="nosort">الموزع</th>
        <th class="nosort">ملاحظات</th>
        <th class="nosort">الحالة</th>
        <th class="nosort">العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaction  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>
                <a href="{{asset($row->image)}}" trarger="_blank"><img src="{{asset($row->image)}}"
                                                                       class="table-user-thumb"
                                                                       alt="{{$row->name}}"></a>
            </td>
            <td>{{$row->package->name_ar}}</td>
            <td>{{$row->provider->name_ar}}</td>
            <td>{!! $row->notes !!}</td>
            <td class="confirm"> @if($row->is_confirmed == 0) غير مؤكدة @else مؤكدة @endif</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('package_bank_transaction.show',$row->id)}}"><i class="ik ik-eye"></i></a>
                    @if($row->is_confirmed === 0)
                        <button class="btn btn-primary submit-transaction" data-id="{{$row->id}}"> تأكيد المعاملة </button>
                    @else
                        <button class="btn btn-primary submit-transaction" data-id="{{$row->id}}"
                                href="{{url('package_bank_transaction/confirm-transaction/'.$row->id)}}">
                            الغاء المعاملة
                        </button>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('more_scripts')
    <script>
        $(document).ready(function () {
            $('.submit-transaction').click(function (e) {
                var id = $(this).data('id');
                var button = $(this);
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('dashboard/package_bank_transaction/confirm-transaction/') }}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    success: function (result) {
                        if (result == 1) {
                            button.html(' الغاء المعاملة');
                            var x = document.getElementsByClassName("confirm");
                            x[0].innerHTML = "  مؤكدة";
                        } else
                        button.html('تاكيد المعاملة');
                        var x = document.getElementsByClassName("confirm");
                        x[0].innerHTML = "غير مؤكدة";
                    }
                });
            });
        });
    </script>
@endsection
