@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="align-middle">
                                    <span class="productId">{{$cart->product_id}}</span>
                                    {{ $cart->pizza_name }}</td>
                                <td class="align-middle"><span class="price">{{ $cart->pizza_price }}</span></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="qtyInput form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cart->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle"><span
                                        class="oneTotalPrice">{{ $cart->qty * $cart->pizza_price }}</span> MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger removeCart" cid="{{$cart->id}}"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><span id="subTotalPrice">{{ $totalPrice }}</span> MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><span id="allTotalPrice">{{ $totalPrice + 3000 }}</span> MMK</h5>
                        </div>
                        <button id="checkOutBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        <a href="{{route('user#remove_all_cart')}}" id="checkOutBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Remove All From Cart</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}';
        $(document).ready(function() {
            $('.cartPage').addClass('active');

            $('.quantity button').click(function() {
                const button = $(this);
                const row = $(this).closest('tr');
                const qty = parseInt(row.find('.qtyInput').val());
                const price = parseInt(row.find('.price').html());
                let oneTotalPrice = row.find('.oneTotalPrice');
                if (button.hasClass('btn-plus')) {
                    getOneTotalPrice(qty,price,oneTotalPrice);
                } else {
                    getOneTotalPrice(qty,price,oneTotalPrice);
       
                }
            });

            //Checkout
            $('#checkOutBtn').click(function(){
                let carts = [];
                let totalPrice = $('#allTotalPrice').html();
                if (totalPrice == '0' || totalPrice=='3000' ) {
                    Swal.fire('Error','There is nothing items in cart!','error')
                    return;
                }
                $('tbody tr').each(function(){
                    carts.push({
                        'productId':$(this).find('.productId').text(),
                        'qty':$(this).find('.qtyInput').val(),
                        'total':$(this).find('.oneTotalPrice').html(),
                    })
                })
                $.ajax({
                    type: "POST",
                    url: "{{route('user#add_order')}}",
                    data: {_token,carts,totalPrice},
                    dataType: "JSON",
                    success: function (data) {
                       if (data.status == true) {
                            Swal.fire('Success!','Ordere create successful','success')
                            $('tbody').html('');
                       }
                    }
                });
            })

            $('.removeCart').click(function(){
                let id = $(this).attr('cid');
                let row = $(this).closest('tr');
                $.ajax({
                type: "GET",
                url: "{{route('user#remvoe_one_cart')}}",
                data: {id},
                dataType: "JSON",
                success: function (data) {
                    console.log('success');
                    if (data.status == true) {
                        row.remove();
                        getTotalPrice();
                    }
                }
            });
            })
        });
        //Remove From Cart
        let removeCart = (id) => {
            alert('hello')

        }

        //all Total Price
        let getTotalPrice = () => {
            let total = 0;
            $('.oneTotalPrice').each(function(){
                total+=parseInt($(this).html())
            })
            $('#subTotalPrice').html(total);
            if (total == 0) {
            $('#allTotalPrice').html(0)
                return
            }
            $('#allTotalPrice').html(total+3000)
            
        }

        //Total Price Without Delivery
        let getOneTotalPrice = (qty,price,place) => {
            place.html(qty*price);
            getTotalPrice();
        }
    </script>
@endpush
