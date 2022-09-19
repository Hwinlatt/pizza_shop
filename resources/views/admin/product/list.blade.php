@extends('admin.layouts.master')
@section('title') Admin-Products @endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <h2 class="title-1">Products List</h2>

                </div>
            </div>
            <div class="table-data__tool-right">
                <a href="{{route('products_createPage')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add product
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
            <form action="{{route('products')}}" method="GET" class="d-flex">
                <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Search">
                <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        </div>
        <div class="row">
            <div class="col-md-3">Totals ({{$products->total()}})</div>
        </div>
        <!-- Category Table -->
        <div class="table-responsive table-responsive-data2">
            @if(count($products) > 0)
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Waiting Time</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                    <tr class="tr-shadow">
                        <td><img src="{{asset('storage/product_photos/'.$p->image)}}" width="100" alt=""></td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->category_name}}</td>
                        <td>{{$p->price}}</td>
                        <td>{{$p->waiting_time}} <i class="fa-solid fa-clock"></i></td>
                        <td>{{$p->view_count}} <i class="fa-solid fa-eye"></i></td>
                        <td>
                            <div class="table-data-feature">
                                <a href="{{route('product_edit_page',$p->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                <a href="{{route('product_delete',$p->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </a>
                                <a href="{{route('product_view_more',$p->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </a >
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center text-secondary">There is no Product Here!</h3>
            @endif
        </div>
        <div>{{$products->appends(request()->query())->links()}}</div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.sBarProduct').addClass('active')
        });
    </script>
@endpush
