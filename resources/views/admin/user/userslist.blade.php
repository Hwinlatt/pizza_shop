@extends('admin.layouts.master')
@section('title') Admin-Products @endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Admin List</h2>

                </div>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                    CSV download
                </button>
            </div>
        </div>
        @if(session('success'))
        <div class="col-4 offset-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <!-- Search Category -->
        <div class="row">
            <div class="col-3 text-secondary">
                <h4>Search key: <span class="text-danger">{{request('key')}}</span></h4>
            </div>
            <div class="col-4 offset-5">
                <form action="{{route('admin#user_list')}}" method="GET" class="d-flex">
                    <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search">
                    <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">Totals ({{$users->total()}})</div>
        </div>
        <!-- Category Table -->
        <div class="table-responsive table-responsive-data2">
            @if(count($users) > 0)
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="tr-shadow">
                        <td><img src="{{asset('storage/profile_photos/'.$user->image)}}" width="100" alt=""></td></td>
                        <td><a href="{{route('admin#user_edit',$user->id)}}" class="btn btn-link">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                           <div class="d-flex">
                            <span class="userId d-none">{{$user->id}}</span>
                            @if($user->id != Auth::user()->id)
                                <select class="mr-1 selectRole" id="">
                                    <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                </select>
                                <button class="btn btn-secondary removeUserBtn">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            @endif
                           </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center text-secondary">There is no User Here!</h3>
            @endif
        </div>
        <div>{{$users->appends(request()->query())->links()}}</div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.sBarUser').addClass('active');

        $('.removeUserBtn').click(function(){
            let row = $(this).closest('tr');
            let uid = row.find('.userId').html();
            $.ajax({
                type: "GET",
                url: "{{route('admin#user_delete')}}",
                data: {uid},
                dataType: "JSON",
                success: function (data) {
                    if (data.status == true) {
                        row.remove();
                    }
                }
            });
        })

        $('.selectRole').change(function(){
            let role = $(this).val();
            let uid = $(this).closest('tr').find('.userId').html();
            console.log(role,uid);
            $.ajax({
                type: "GET",
                url: "{{route('admin#chage_role')}}",
                data: {role,uid},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        
                    }
                }
            });
        })
    });
</script>
@endpush
