@extends('admin.layout.master')
@section('title','password change')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
{{--                    @if(session('status'))--}}
{{--                        <div class="alert alert-warning">--}}
{{--                            <strong class="text-danger">{{session('status')}}</strong>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title ">
                                <h3 class="text-center title-2">Change Password</h3>

                            </div>
                            <hr>
                            <form action="{{route('password_update')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                    <input id="oldPassword" value="{{old('oldPassword')}}" name="oldPassword" type="password" class="form-control @if(session('status'))is-invalid @endif  @error('oldPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                    @error('oldPassword')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                    @if(session('status'))
                                        <div class="invalid-feedback">
                                            <strong class="text-danger">{{session('status')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="newPassword" class="control-label mb-1">New Password</label>
                                    <input id="newPassword" value="{{old('newPassword')}}" name="newPassword" type="password" class="form-control @error('newPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                    @error('newPassword')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                    <input id="confirmPassword" value="{{old('confirmPassword')}}" name="confirmPassword" type="password" class="form-control @error('confirmPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                    @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                        <span id="payment-button-amount">
                                            Change Password
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
