@extends('admin.layout.master')
@section('title','Product List')
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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product_create')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                                <th>Image</th>
                                <th> Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th class="text-nowrap">Waiting Time</th>
                                <th class="text-nowrap">View Count</th>
                                <th>Control</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $p)
                                <tr class="tr-shadow">
                                    <td class="text-center">{{$p->id}}</td>
                                    <td>
                                        <img src="{{asset('storage/product/'.$p->image)}}" class="img-thumbnail" style="width: 50px;" alt="">
                                    </td>
                                    <td class="desc text-nowrap">{{$p->name}}</td>
                                    <td class="desc ">{{\Illuminate\Support\Str::words($p->description,3,'...')}}</td>
                                    <td class="desc text-center">{{$p->category->name}}</td>
                                    <td class="desc">{{$p->price}}</td>
                                    <td class="text-center">{{$p->waiting_time}} hr
                                    </td>
                                    <td class="text-center">{{$p->view_count}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('product_detail',$p->id)}}" class="mr-2">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-eye text-info"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('product_edit',$p->id)}}" class="mr-2">
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit text-success"></i>
                                                </button>
                                            </a>
                                            <form action="{{route('product_delete',$p->id)}}" method="post">
                                                @csrf
                                                <button class="item " data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9">There is no Product</td>
                                </tr>
                            @endforelse

                            </tbody>

                        </table>
                    </div>
                    <div class="mt-2">
                        {{$products->links()}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

    @stop
