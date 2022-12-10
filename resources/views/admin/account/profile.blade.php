@extends('admin.layout.master')
@section('title','profile')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
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
                            <form action="{{route('password_update')}}" method="post" class="d-flex justify-content-between" novalidate="novalidate">
                                @csrf
                                <div class="profile_img  ">
                                    @if($user->profile == 'default_profile.png')
                                        <img src="{{ $user->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class="w-100 img-thumbnail" alt="">
                                    @else
                                        <img src="{{asset('storage/profile/'.$user->profile)}}" class="img-thumbnail rounded-circle" alt="">
                                    @endif
                                </div>
                                <div class="w-50 ">
                                    <p class="text-black-50 mb-2 text-uppercase">
                                        <i class="fa fa-user fa-fw text-secondary"></i> {{$user->name}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-envelope fa-fw text-secondary"></i> {{$user->email}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-phone fa-fw text-secondary"></i> {{$user->phone}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-map-marker-alt fa-fw text-secondary"></i> {{$user->address}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fas fa-venus-mars fa-fw text-secondary"></i> {{$user->gender}}
                                    </p>
                                    <p class="text-black-50 mb-2 font-weight-lighter ">
                                        <i class="fa fa-calendar-alt fa-fw text-secondary"></i> {{$user->created_at->format('D, F d, Y')}}
                                    </p>
                                    @if($user->id == \Illuminate\Support\Facades\Auth::id())
                                        <a href="{{route('profile_change',\Illuminate\Support\Facades\Auth::id())}}" class="btn btn-secondary w-75">
                                            Edit Profile <i class="fa fa-arrow-right fa-fw ml-1"></i>
                                        </a>
                                    @endif
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
