@extends('admin.layout.master')
@section('title','profile')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-8 offset-2">
                    <div class="card p-4">
                        <div class="card-title text-center">
                            <h4 class="text-black-50">Account Info</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('password_update')}}" method="post" class="d-flex justify-content-between" novalidate="novalidate">
                                @csrf
                                <div class="profile_img img-thumbnail  ">
                                    @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                        <img src="{{asset('admin/images/default_profile.png')}}" class="w-100 " alt="">
                                    @else
                                        <img src="" class="img-thumbnail rounded-circle" alt="">

                                    @endif
                                </div>

                                <div class="w-50">
                                    <div class="form-group">
                                        <label for="userName" class="control-label mb-1">
                                            <i class="fa fa-user fa-fw text-secondary"></i> Name
                                        </label>
                                        <input id="userName" value="{{old('userName',Auth::user()->name)}}" name="userName" type="text" class="form-control  @error('userName')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('userName')
                                        <div class="invalid-feedback">
                                            <strong class="text-danger">{{$message}}</strong>
                                        </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="userEmail" class="control-label mb-1">
                                            <i class="fa fa-envelope fa-fw text-secondary"></i> Email
                                        </label>
                                        <input id="userEmail" value="{{old('userEmail',Auth::user()->email)}}" name="userEmail" type="email" class="form-control  @error('userEmail')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('userEmail')
                                        <div class="invalid-feedback">
                                            <strong class="text-danger">{{$message}}</strong>
                                        </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="userPhone" class="control-label mb-1">
                                            <i class="fa fa-phone fa-fw text-secondary"></i> Phone
                                        </label>
                                        <input id="userPhone" value="{{old('userPhone',Auth::user()->phone)}}" name="userPhone" type="text" class="form-control  @error('userPhone')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('userPhone')
                                        <div class="invalid-feedback">
                                            <strong class="text-danger">{{$message}}</strong>
                                        </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">
                                            <i class="fa fa-map-marker-alt fa-fw text-secondary"></i> Address
                                        </label>
                                        <input id="address" value="{{old('address',Auth::user()->name)}}" name="address" type="text" class="form-control  @error('address')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('address')
                                        <div class="invalid-feedback">
                                            <strong class="text-danger">{{$message}}</strong>
                                        </div>
                                        @enderror

                                    </div>
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
