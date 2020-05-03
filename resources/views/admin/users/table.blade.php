<table id="data_table" class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>البريد الاليكترونى</th>
        <th class="nosort">الإجراءات</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($users  as $user)
        <tr>
            <td>{{ $user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{ route('users.edit', $user->id) }}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$user->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>

                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
