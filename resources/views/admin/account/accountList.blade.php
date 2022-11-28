
@extends('admin.layout.master')
@section('title','account list')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">
                                    <i class="fa fa-list fa-fw "></i> Account List
                                </h2>

                            </div>
                        </div>

                    </div>

                    {{--                show status--}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            <p>{{session('status')}}</p>
                        </div>
                    @endif
                    {{--                Search--}}
                    <div class="row justify-content-end px-2">
                        <div class="col-4 ">

                            <form action="" method="get" class="d-flex ">
                                <input type="text" class="form-control" name="searchKey" value="{{request('searchKey')}}" placeholder="search anything ...">
                                <button class="btn btn-success btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

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
                                            <img src="{{asset('admin/images/default_profile.png')}}" class="img-thumbnail" style="width: 100px;" alt="">
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
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
