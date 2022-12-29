
@extends('admin.layout.master')
@section('title','account list')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content mt-lg-0 mt-md-5">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                    <!-- DATA TABLE -->
                    {{--                show status--}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            <p>{{session('status')}}</p>
                        </div>
                    @endif
                    {{--                Search--}}
                    <div class="row d-flex justify-content-end px-2">
                        <div class=" col-3 ">
                            <form action="" method="get" class="d-flex ">
                                <input type="text" class="form-control" name="searchKey" value="{{request('searchKey')}}" placeholder="search anything ...">
                                <button class="btn btn-success btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 ">
                                    <thead>
                                    <tr >
                                        <th>ID</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>
                                                @if($user->profile == 'default_profile.png')
                                                    <img src="{{ $user->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class=" img-thumbnail" style="width: 100px;" alt="">
                                                @else
                                                    <img src="{{asset('storage/profile/'.$user->profile)}}" class="img-thumbnail" style="width: 100px;" alt="">
                                                @endif
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if($user->id != Auth::id())
                                                        @if($user->role != 'admin')
                                                            <form action="{{route('account_change_role',$user->id)}}" method="post" class="mr-2">
                                                                @csrf
                                                                <input type="hidden" name="role" value="{{$user->role}}">
                                                                <button type="submit" class="item " data-toggle="tooltip" data-placement="top" title="Change Admin">
                                                                    <i class="fa-solid fa-recycle text-secondary"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('account_change_role',$user->id)}}" method="post" class="mr-2">
                                                                @csrf
                                                                <input type="hidden" name="role" value="{{$user->role}}">
                                                                <button type="submit" class="item " data-toggle="tooltip" data-placement="top" title="Change User">
                                                                    <i class="fa-solid fa-recycle text-success"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                    <a href="{{route('profile',$user->id)}}" class="mr-2">
                                                        <button class="item " data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="zmdi zmdi-eye text-info"></i>
                                                        </button>
                                                    </a>
                                                    @if($user->id != Auth::id())
                                                        <form action="{{route('account_delete',$user->id)}}" method="post">
                                                            @csrf
                                                            <button type="submit" class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <div class="mt-2">
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
