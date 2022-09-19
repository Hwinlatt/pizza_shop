@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 card p-4">
            <h3 class="text-center mt-3">Pizza Detail</h3>
            <div class="line-mf mt-2 mb-4"></div>
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="mb-3">
                            <img src="{{asset('storage/product_photos/'.$product->image)}}" class="ms-2 w-100 rounded" width="250" alt="">
                        </div>
                        <a href=""  class="btn btn-dark w-100"><i class="fa-solid fa-pen-to-square "></i> Edit Pizza</a>

                    </div>

                    <div class="col-md-8">
                        <h4>{{$product->name}}</h4>
                        <div class="my-2">
                            <span class="btn btn-sm btn-dark me-2"><i class="fa-solid fa-money-bill"></i> {{$product->price}}</span>
                            <span class="btn btn-sm btn-dark me-2"><i class="fa-solid fa-clock"></i> {{$product->waiting_time}}</span>
                            <span class="btn btn-sm btn-dark me-2"><i class="fa-solid fa-eye"></i> {{$product->view_count}}</span>
                            <span class="btn btn-sm btn-dark me-2"><i class="fa-solid fa-note-sticky"></i> {{$product->category_id}}</span>
                            <span class="btn btn-sm btn-dark me-2"><i class="fa-solid fa-user-clock"></i> {{$product->created_at}}</span>
                            <div class="my-2">
                                <span><i class="fa-solid fa-money-check"></i> Details</span>
                                <p>{{$product->descriptin}}</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
