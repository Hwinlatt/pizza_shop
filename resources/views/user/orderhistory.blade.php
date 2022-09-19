@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <span class="breadcrumb-item active">Order History</span>
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
                            <th>Data</th>
                            <th>Order Code</th>
                            <th>Total Amout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{$order->created_at->format('F-d-Y')}}</td>
                            <td class="align-middle">{{$order->order_code}}</td>
                            <td class="align-middle">{{$order->total_price}}</td>
                            <td class="align-middle">
                                @if($order->status == '0')
                                    <span class="badge badge-primary fs-6 shadow"><i class="fa-solid fa-clock-rotate-left"></i> Pending</span>
                                    @elseif ($order->status == '1')
                                    <span class="badge badge-success fs-6 shadow"><i class="fa-solid fa-check"></i> Success</span>
                                    @elseif ($order->status == '2')
                                    <span class="badge badge-danger fs-6 shadow"><i class="fa-solid fa-triangle-exclamation"></i> Reject</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
