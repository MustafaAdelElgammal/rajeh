<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">العميل</th>
        <th class="nosort">الرسالة</th>
        <th class="nosort">منذ</th>
        <th class="nosort">العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $msg as $row )
        <tr>
            <td>{{ $row->id }}</td>
            @if($row->client_from != null)
            <td>{!! $row->client_from->name !!}</td>
            @else
             <td>{!! $row->client_to->name !!}</td>
            @endif
            <td>{!! $row->message !!}</td>
            <td>{!! $row['created_at'] !!}</td>
            <td>
                <div class="table-actions text-left">
                    <div class="table-actions text-left">
                        <a href="{{route('customer-support.show',$row->id)}}"><i class="ik ik-eye"></i></a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
