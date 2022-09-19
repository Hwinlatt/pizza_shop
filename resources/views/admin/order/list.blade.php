@extends('admin.layouts.master')
@section('title')
    Order-list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Order List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
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
                <div class="col-3 text-secondary">
                    <h4>Search key: <span class="text-danger">{{ request('key') }}</span></h4>
                </div>
                <div class="col-4 offset-5">
                    <form action="{{ route('admin#order_list') }}" method="GET" class="">
                        <div class="d-flex">
                            <input type="text" name="key" value="{{ request('key') }}" class="form-control"
                                placeholder="Enter Order Code">
                            <button class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <hr>
                        Order Status <i class="fa-solid fa-filter"></i>
                        <select id="filterByStatus" name="f_status" class="form-control">
                            <option value="" @if (request('f_status') == '') selected @endif>All</option>
                            <option value="0" @if (request('f_status') == '0') selected @endif>Pending</option>
                            <option value="1" @if (request('f_status') == '1') selected @endif>Success</option>
                            <option value="2" @if (request('f_status') == '2') selected @endif>Reject</option>
                        </select>
                    </form>
                    <div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">Totals ({{ $orders->total() }})</div>
            </div>

            <!-- Category Table -->
            <div class="table-responsive table-responsive-data2">
                @if (count($orders) != '0')
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td><a href="{{route('admin#order_info',$order->order_code)}}" class="btn btn-link">{{ $order->order_code }}</a></td>
                                    <td>{{ $order->created_at->format('F-d-Y') }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="" id="" class="form-control changeStatus"
                                                oid="{{ $order->id }}">
                                                <option value="0" @if ($order->status == '0') selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" @if ($order->status == '1') selected @endif>
                                                    Success
                                                </option>
                                                <option value="2" @if ($order->status == '2') selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-secondary">There is no Order Here!</h3>
                @endif
            </div>
            <div>{{ $orders->appends(request()->query())->links() }}</div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sBarOrder').addClass('active');

            $('#filterByStatus').change(function() {
               $(this).closest('form').submit();
            })

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
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
        });
    </script>
@endpush
