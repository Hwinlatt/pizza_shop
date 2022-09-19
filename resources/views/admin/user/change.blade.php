@extends('layouts.master')

@section('title')
    Password Change
@endsection
@section('content')
@if(session('success'))
        <code class="text-success"><i class="fa-solid fa-check"></i> {{session('success')}}</code>
    @endif
    @if(session('warning'))
        <code>>> {{session('warning')}}</code>
    @endif
    @if ($errors->any())
        <div class="mb-2">
            @foreach ($errors->all() as $error)
                <code>>> {{ $error }}</code><br>
            @endforeach
        </div>
    @endif
    <div class="login-form">
        <form action="{{ route('user#change_pass') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input class="au-input au-input--full" type="email" name="email" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group">
                <label>Enter Old Password</label>
                <input class="au-input au-input--full" type="password" name="oldPassword" placeholder="Old Password">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input class="au-input au-input--full" type="password" name="newPassword" placeholder="New Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="confirmPassword"
                    placeholder="Confirm New Password">
            </div>
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Change Password</button>
            <a href="{{route('category#list')}}" class="btn btn-secondary w-100">Cancel</a>
        </form>
        {{-- <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
        </p>
    </div> --}}
    </div>
@endsection