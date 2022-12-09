@extends('user.layout.master')
@section('title','profile')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="container-fluid">
        <div class="col-8 offset-2">

            @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
            @endif

            <div class="card py-3">
                <div class="card-title text-center">
                    <h4 class="text-black-50">Account Info</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="d-flex justify-content-around" novalidate="novalidate">
                        @csrf
                        <div class="profile_img w-25  " >
                            @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class="w-100 img-thumbnail" alt="">
                            @else
                                <img src="{{asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->profile)}}" class=" w-100 img-thumbnail rounded-circle"  alt="">
                            @endif
                        </div>
                        <div class="w-50 ">
                            <p class="text-black-50 mb-3 text-uppercase">
                                <i class="fa fa-user fa-fw "></i> {{\Illuminate\Support\Facades\Auth::user()->name}}
                            </p>
                            <p class="text-black-50 mb-3 font-weight-lighter ">
                                <i class="fa fa-envelope fa-fw "></i> {{\Illuminate\Support\Facades\Auth::user()->email}}
                            </p>
                            <p class="text-black-50 mb-3 font-weight-lighter ">
                                <i class="fa fa-phone fa-fw "></i> {{\Illuminate\Support\Facades\Auth::user()->phone}}
                            </p>
                            <p class="text-black-50 mb-3 font-weight-lighter ">
                                <i class="fa fa-map-marker-alt fa-fw "></i> {{\Illuminate\Support\Facades\Auth::user()->address}}
                            </p>
                            <p class="text-black-50 mb-3 font-weight-lighter ">
                                <i class="fas fa-venus-mars fa-fw "></i> {{\Illuminate\Support\Facades\Auth::user()->gender}}
                            </p>
                            <p class="text-black-50 mb-3 font-weight-lighter ">
                                <i class="fa fa-calendar-alt fa-fw"></i> {{\Illuminate\Support\Facades\Auth::user()->created_at->format('D, F d, Y')}}
                            </p>
                            <a href="{{route('user_profileChange',\Illuminate\Support\Facades\Auth::id())}}" class="btn btn-primary w-75">
                                Edit Profile <i class="fa fa-arrow-right fa-fw ml-1"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
