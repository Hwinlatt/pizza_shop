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
                <form action="{{route('admin#list')}}" method="GET" class="d-flex">
                    <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search">
                    <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">Totals ({{$admins->total()}})</div>
        </div>
        <!-- Category Table -->
        <div class="table-responsive table-responsive-data2">
            @if(count($admins) > 0)
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
                    @foreach ($admins as $admin)
                    <tr class="tr-shadow">
                        <td><img src="{{asset('storage/profile_photos/'.$admin->image)}}" width="100" alt=""></td></td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->gender}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>{{$admin->address}}</td>
                        <td>
                            @if($admin->id != Auth::user()->id)
                            <div class="table-data-feature">
                                @if($admin->role == 'admin')
                                <a href="{{route('admin#user_change',$admin->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Change to user">
                                    <i class="fa-solid fa-person-circle-minus"></i>
                                </a>
                                @else
                                
                                @endif
                                <a href="{{route('admin#destroy',$admin->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                                </a>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center text-secondary">There is no Admin Here!</h3>
            @endif
        </div>
        <div>{{$admins->appends(request()->query())->links()}}</div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
       
    });
</script>
@endpush
