
@extends('admin.layout.master')
@section('title','category list')
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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category_create')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
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
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                      @forelse($categories as $c)
                            <tr class="tr-shadow">
                                <td>{{$c->id}}</td>
                                <td class="desc">{{$c->name}}</td>
                                <td>{{$c->created_at->format('D, F d, Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('category_edit',$c->id)}}" class="mr-2">
                                            <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit text-success"></i>
                                            </button>
                                        </a>
                                        <form action="{{route('category_delete',$c->id)}}" method="post">
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
                              <td class="text-center" colspan="4">There is no Category</td>
                          </tr>
                      @endforelse

                        </tbody>

                    </table>
                </div>
                <div class="mt-2">
                    {{$categories->appends(request()->query())->links()}}
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@stop
