@extends('admin.layouts.master')

@section('title')
    Order-Info
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="row mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-linke text-dark"><i class="fa-solid fa-arrow-left-long"></i>
                    Back</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-clipboard"></i> Order Info</h4>
                            <small class="text-danger">Include Delivery Charges</small>
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col"><i class="fa-solid fa-user"></i> Name</div>
                                <div class="col">{{ $order_info->user_name }}</div>
                            </div>
                            <div class="row my-2">
                                <div class="col"><i class="fa-solid fa-barcode"></i> Ordre Code</div>
                                <div class="col">{{ $order_info->order_code }}</div>
                            </div>
                            <div class="row my-2">
                                <div class="col"><i class="fa-regular fa-calendar-days"></i> Ordre Date</div>
                                <div class="col">{{ $order_info->created_at->format('F-d-Y') }}</div>
                            </div>
                            <div class="row my-2">
                                <div class="col"><i class="fa-solid fa-money-bill-wave"></i> Total</div>
                                <div class="col">{{ $order_info->total_price }} MMK</div>
                            </div>
                            <div class="row my-2">
                                <div class="col">Status</div>
                                <div class="col">
                                    <select name="" id="" class="form-control changeStatus"
                                        oid="{{ $order_info->id }}">
                                        <option value="0" @if ($order_info->status == '0') selected @endif>
                                            Pending
                                        </option>
                                        <option value="1" @if ($order_info->status == '1') selected @endif>
                                            Success
                                        </option>
                                        <option value="2" @if ($order_info->status == '2') selected @endif>
                                            Reject
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <!-- Search Category -->

            <div class="row">
                {{-- <div class="col-md-3">Totals ({{ $orders->total() }})</div> --}}
            </div>

            <!-- Category Table -->
            <div class="table-responsive table-responsive-data2">
                @if (count($order_items) != '0')
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img style="height:100px;"
                                            src="{{ asset('storage/product_photos/' . $item->product_image) }}"
                                            alt=""></td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->created_at->format('F-d-Y') }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->total }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-secondary">There is no Order Here!</h3>
                @endif
            </div>
            {{-- <div>{{ $orders->appends(request()->query())->links() }}</div> --}}
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.sBarOrder').addClass('active');
        $('.changeStatus').change(function() {
                let id = $(this).attr('oid');
                let status = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin#order_chage') }}",
                    data: {
                        id,
                        status
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == true) {
                            alert('Changed Order Status!')
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
    });
</script>
@endpush
