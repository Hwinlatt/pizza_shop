@extends('admin.layouts.master')

@section('title')
    Contact-info
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('admin#contact_list')}}" class="btn btn-link text-dark"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
        </div>
        <div class="col-md-12" >
            <div class="card" style="min-height: 400px">
                <div class="card-header w-100">
                    <h5 class="my-2">From : {{$contact->name}}</h5>
                    <h5 class="my-2">Email : {{$contact->email}}</h5>
                    <h5 class="my-2">Subject : {{$contact->subject}}</h5>
                </div>
                <div class="card-body">
                    <p>{{$contact->message}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sBarContact').addClass('active');

        });
    </script>
@endpush
