@extends('layout.master')
@section('title','RegisterPage')
@section('content')
    <div class="login-form">
        <form action="{{route('register')}}" method="post">
            @csrf
            @error('terms')
            <small class="text-danger font-weight-bolder">{{$message}}</small>
            @enderror
            <div class="form-group">
                <label>Username</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}" type="text" name="name" placeholder="Username">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email')}}" type="email" name="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>User Phone</label>
                <input class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone')}}" type="text" name="phone" placeholder="09*********">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label> Address</label>
                <input class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone')}}" type="text" name="address" placeholder="address">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password') is-invalid @enderror"  type="password" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror"  type="password" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger fw-bolder">{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>

    @stop
