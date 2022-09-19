@extends('layouts.master')

@section('title') Register @endsection
@section('content')
<div class="login-form">

    <form action="{{route('register')}}" class="" method="POST">
        @csrf
        @error('terms') <small class="text-danger">{{$message}}</small> @enderror
        <div class="form-group">
            <label>Name</label>
            <input value="{{old('name')}}" class="au-input au-input--full" type="text" name="name" placeholder="Username">
            @error('name') <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input value="{{old('email')}}" class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email') <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input value="{{old('phone')}}" class="au-input au-input--full" type="number" name="phone" placeholder="Phone number">
            @error('phone') <small class="text-danger">{{$message}}</small> @enderror
        </div>
         <div class="form-group">
            <label>Address</label>
            <input value="{{old('address')}}" class="au-input au-input--full" type="text" name="address" placeholder="Address">
            @error('address') <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" id="">
                <option value="">Select Gender ....</option>
                <option value="male" @if(old('gender')=='male') selected @endif >Male</option>
                <option value="female"@if(old('gender')=='female') selected @endif >Female</option>
            </select>
            @error('gender') <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input  class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password') <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label>Comfirm Password</label>
            <input  class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{route('auth#loginPage')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection
