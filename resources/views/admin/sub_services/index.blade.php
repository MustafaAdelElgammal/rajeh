@extends('admin.layouts.master')
@section('title','الخدمات الثانوية')
@section('content')
<div class="row align-items-end">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>الخدمات الثانوية</h3>
                    <a class="btn btn-primary btn-rounded m-auto mr-0" href="{{route('sub_services.create')}}"><i class="ik ik-plus-circle"></i>اضافة خدمة ثانوية</a>
                </div>
                <div class="card-body">
                	@include('admin.sub_services.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('more_scripts')
    <script>
        function Delete(id){
            Swal.fire({
                title: 'هل انت متاكد؟',
                text: "عند الحذف لا يمكن استرجاع البيانات",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم احذف'
            }).then((result) => {
                if (result.value) {
                $(id).submit();
            }
        })
        }
    </script>
@endsection
