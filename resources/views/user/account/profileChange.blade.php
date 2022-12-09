@extends('user.layout.master')
@section('title','edit profile')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-5  m-auto">
                <div class="card p-4">
                    <div class="card-title text-center">
                        <h4 class="text-black-50">Edit Account Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="position-relative d-flex justify-content-center mb-3 w-50"  style="margin: auto;">
                            <button class="btn btn-secondary btn-sm position-absolute edit-btn " style="bottom:-10px;  " >
                                <i class="fa fa-edit fa-fw "></i>
                            </button>
                            @if(Auth::user()->profile == 'default_profile.png')
                                <img src="{{asset('admin/images/default_profile.png')}}"  class=" img-thumbnail profile-image " alt="">
                            @else
                                <img src="{{asset('storage/profile/'.Auth::user()->profile)}}" class="img-thumbnail profile-image  "  alt="">

                            @endif

                        </div>
                        <form action="{{route('user_profileUpdate',\Illuminate\Support\Facades\Auth::id())}}"  method="post" enctype="multipart/form-data"  novalidate="novalidate">
                            @csrf
                            <input id="userProfile" value="{{old('userProfile',Auth::user()->profile)}}" name="userProfile" type="file" hidden class="form-control  @error('userProfile')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                            @error('userProfile')
                            <div class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="userName" class="control-label mb-1">
                                    <i class="fa fa-user fa-fw "></i> Name
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
                                    <i class="fa fa-envelope fa-fw "></i> Email
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
                                    <i class="fa fa-phone fa-fw "></i> Phone
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
                                    <i class="fa fa-map-marker-alt fa-fw "></i> Address
                                </label>
                                <textarea id="address" value="" name="address" type="text" class="form-control  @error('address')is-invalid @enderror" cols="30" rows="2">{{old('address',Auth::user()->address)}}</textarea>
                                @error('address')
                                <div class="invalid-feedback">
                                    <strong class="text-danger">{{$message}}</strong>
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="role" class="control-label mb-1">
                                    <i class="far fa-user-circle"></i> Role
                                </label>
                                <input id="role" value="{{old('role',Auth::user()->role)}}" disabled name="role" type="text" class="form-control  @error('role')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('role')
                                <div class="invalid-feedback">
                                    <strong class="text-danger">{{$message}}</strong>
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label> <i class="fas fa-venus-mars"></i>Gender</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                    <option value="">Choose gender ...</option>
                                    <option value="male" {{Auth::user()->gender == 'male' ? 'selected':''}}>Male</option>
                                    <option value="female" {{Auth::user()->gender == 'female' ? 'selected':''}} >Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger fw-bolder">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary w-100">
                                    <i class="fa-solid fa-arrow-up-from-bracket mr-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop

@push('script')
    <script>
        let editBtn = document.querySelector('.edit-btn');
        let userProfile = document.querySelector('#userProfile');
        let profileImage = document.querySelector('.profile-image');
        editBtn.addEventListener('click',function () {
            userProfile.click();
        });
        userProfile.addEventListener('change',function () {
            let reader = new FileReader();
            // console.log(reader);
            let file = userProfile.files[0];
            reader.onload = function () {
                profileImage.src = reader.result;
            };
            reader.readAsDataURL(file);

        });
     </script>
@endpush
