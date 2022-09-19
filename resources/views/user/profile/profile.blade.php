@extends('user.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="{{ route('profile',Auth::user()->id) }}" method="post" enctype="multipart/form-data">

            <div class="row">
                @if(session('status'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('status')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="col-md-1"></div>
                <div class="col-md-4 p-3 card">
                    <div class="d-flex justify-content-center">
                        @if (Auth::user()->image == null)
                        <img src="{{ asset('image/user.png') }}" height="300px" width="300px" alt="CoolAdmin">
                        @else
                        <img src="{{asset('storage/profile_photos/'.Auth::user()->image)}}" height="300px" width="300px" alt="">
                        @endif
                    </div>
                    <div class="form-group my-1">
                        <input class="form-control" type="file" name="image">
                        @error('image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark my-2"><i class="fa-solid fa-circle-up"></i> Update
                        Profile</button>
                </div>
                <div class="col-md-6 p-3 card d-flex justify-content-around flex-column">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ Auth::user()->name }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter Email">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Enter Address">{{ Auth::user()->address }}</textarea>
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control @error('phone') is-invalid @enderror" type="number" name="phone" placeholder="Enter Phone number" value="{{ Auth::user()->phone }}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                            <option value="">Select Gender ....</option>
                            <option value="male" @if (old('gender', Auth::user()->gender) == 'male') selected @endif>Male</option>
                            <option value="female" @if (old('gender', Auth::user()->gender) == 'female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input class="form-control @error('role') is-invalid @enderror" type="text" name="role" placeholder="" value="{{ Auth::user()->role }}" disabled>
                    </div>

                </div>
            </div>
    </div>
</div>
</form>
@endsection
