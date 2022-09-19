@extends('admin.layouts.master')

@section('content')
<a href="@if(Auth::user()->id == $user->id) {{route('profile')}} @else {{route('admin#user_list')}} @endif" class="row btn btn-linke text-dark"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    <form action="{{ route('user#profile_update', $user->id) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4 p-3 card">

                @if ($user->image == null)
                    <img src="{{ asset('image/user.png') }}" alt="CoolAdmin">
                @else
                    <img src="{{asset('storage/profile_photos/'.$user->image)}}" alt="">
                @endif
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
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $user->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        value="{{ $user->email }}" placeholder="Enter Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" type="text" name="address"
                        placeholder="Enter Address">{{ $user->address }}</textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input class="form-control @error('phone') is-invalid @enderror" type="number" name="phone"
                        placeholder="Enter Phone number" value="{{ $user->phone }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                        <option value="">Select Gender ....</option>
                        <option value="male" @if (old('gender', $user->gender) == 'male') selected @endif>Male</option>
                        <option value="female"@if (old('gender', $user->gender) == 'female') selected @endif>Female</option>
                    </select>
                    @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input class="form-control @error('role') is-invalid @enderror" type="text" name="role"
                        placeholder="" value="{{ $user->role }}" disabled>
                </div>

            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
        $('.sBarUser').addClass('active');

</script>
@endpush
