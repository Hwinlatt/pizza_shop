@extends('admin.layouts.master')
@section('title') Admin-List @endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Category List</h2>

                </div>
            </div>
            <div class="table-data__tool-right">
                <a href="{{route('category#createPage')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add category
                    </button>
                </a>
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
            <div class="col-3 text-secondary"><h4>Search key: <span class="text-danger">{{request('key')}}</span></h4></div>
        <div class="col-4 offset-5">
            <form action="{{route('category#list')}}" method="GET" class="d-flex">
                <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search">
                <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        </div>
        <div class="row">
            <div class="col-md-3">Totals ({{$categories->total()}})</div>
        </div>

        <!-- Category Table -->
        <div class="table-responsive table-responsive-data2">
            @if(count($categories) != '0')
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Category Name</th>
                        <th>Created Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="tr-shadow">
                        <td>{{$category->id}}</td>
                        <td>
                            <span class="block-email">{{$category->name}}</span>
                        </td>
                        <td>{{$category->created_at->format('d-F-Y | h:m:s A')}}</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="{{route('category#edit',$category->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                <a href="{{route('category#delete',$category->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center text-secondary">There is no Category Here!</h3>
            @endif
        </div>
        <div>{{$categories->appends(request()->query())->links()}}</div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.sBarCategory').addClass('active')
        });
    </script>
@endpush
