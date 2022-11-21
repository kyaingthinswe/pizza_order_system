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
                                <div class="profile_img img-thumbnail ">
                                    @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                        <img src="{{asset('admin/images/default_profile.png')}}" class="w-100 " alt="">
                                    @else
                                        <img src="" class="img-thumbnail rounded-circle" alt="">

                                    @endif
                                </div>
                                <div class="w-50 ">
                                    <p class="text-black-50 mb-2 text-uppercase">
                                        <i class="fa fa-user fa-fw text-secondary"></i> {{Auth::user()->name}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-envelope fa-fw text-secondary"></i> {{Auth::user()->email}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-phone fa-fw text-secondary"></i> {{Auth::user()->phone}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                         <i class="fa fa-map-marker-alt fa-fw text-secondary"></i> {{Auth::user()->address}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-calendar-alt fa-fw text-secondary"></i> {{Auth::user()->created_at->format('D, F d, Y')}}
                                    </p>
                                    <a href="{{route('profile_change')}}" class="btn btn-secondary w-75">
                                        Edit Profile <i class="fa fa-arrow-right fa-fw ml-1"></i>
                                    </a>

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
