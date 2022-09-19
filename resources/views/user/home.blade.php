@extends('user.layouts.master')

@section('content')
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                    Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="bg-black px-2 rounded  py-1 d-flex align-items-center justify-content-between mb-3">
                        <h3 class=" text-light" for="price-all">Category</h3>
                        <span class="badge bg-dark p-2">{{ count($categories) }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('user#home') }}" class="text-dark">All</a>
                    </div>
                    @foreach ($categories as $c)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#pizza_filter', $c->id) }}" class="text-dark">{{ $c->name }}</a>
                        </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4 my-2">
                        <div>
                            <a href="{{ route('user#cart_list') }}" type="button"
                                class="btn btn-primary position-relative">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span id="getCardCount"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                </span>
                            </a>
                            <a href="{{route('user#order_history')}}" type="button"
                                class="btn btn-primary position-relative ms-3">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span id="getOrderCount"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                </span>
                            </a>
                        </div>
                        <div>
                        </div>
                        <div class="ml-2">
                            <select name="" id="soriting" class="form-select" style="user-select: none">
                                <option value="asc">Ascending</option>
                                <option selected value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap" id="pizzaList">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 200px"
                                            src="{{ asset('storage/product_photos/' . $product->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('user#pizza_detail', $product->id) }}"><i
                                                    class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->price }} kyats</h5>
                                            <h6 class="text-muted ml-2"><del></del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-100">
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-pizza-slice"></i> There is no Pizza!
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            getCardCount();
            $('.homePage').addClass('active');
            $('#soriting').change(function() {
                let sortBy = $(this).val();
                $('#pizzaList').html(loading());
                $.ajax({
                    type: "GET",
                    url: "{{ route('user#pizza_sorting') }}",
                    data: {
                        sortBy
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        let list = ''
                        for (let i = 0; i < data.length; i++) {
                            list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 200px"
                                        src="{{ asset('storage/product_photos/`+data[i].image+`') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ url('user/pizza/detail/`+data[i].id+`') }}"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data[i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data[i].price} kyats</h5>
                                        <h6 class="text-muted ml-2"><del></del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`

                        }
                        $('#pizzaList').html(list);
                    }
                });
            })
        });
    </script>
@endpush
