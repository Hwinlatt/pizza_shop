@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 p-3 card">
            @if (Auth::user()->image == null)
                <img src="{{ asset('image/user.png') }}" alt="CoolAdmin">
            @else
            <img src="{{asset('storage/profile_photos/'.Auth::user()->image)}}" alt="">
            @endif
            <a href="{{route('user#profile_edit')}}" class="btn btn-dark w-100 my-1">Edit User</a>
        </div>
        <div class="col-md-6 p-3 card d-flex justify-content-around flex-column">
            <h5><i class="fa-solid fa-address-card"></i> {{Auth::user()->name}} <span class="badge badge-primary py-2">{{Auth::user()->role}}</span></h5>
            <h5><i class="fa-solid fa-envelope"></i> {{Auth::user()->email}}</h5>
            <h5><i class="fa-solid fa-map-location"></i> {{Auth::user()->address}}</h5>
            <h5><i class="fa-solid fa-square-phone"></i> {{Auth::user()->phone}}</h5>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
