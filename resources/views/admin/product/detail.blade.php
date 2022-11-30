@extends('admin.layout.master')
@section('title','product detail')
@section('content')
    <!-- MAIN CONTENT-->
{{--    {{dd($product)}}--}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="card-title ">
                                <span class="float-left">
                                    <button onclick="history.back()">
                                        <i class="fa fa-arrow-left text-muted"></i>
                                    </button>
                                </span>
                                <h5 class="text-center title-2">
                                    {{$product->name}}
                                    <span class="badge badge-pill badge-secondary px-2">
                                        <small>{{$product->category->name}}</small>
                                    </span>
                                </h5>
                            </div>
                            <div class=" m-auto w-75">
                                <img src="{{asset('storage/product/'.$product->image)}}" class="img-thumbnail w-100" alt="">
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between w-75 m-auto">
                                    <div class="">
                                        <p class="badge  p-2 " >
                                            <i class="fas fa-dollar-sign mr-1"></i>{{$product->price}}
                                        </p>
                                        <p class="badge  p-2 " >
                                            <i class="fa fa-user-clock fa-fw mr-1"></i>{{$product->waiting_time}}
                                        </p>
                                        <p class="badge  p-2 " >
                                            <i class="fa fa-eye fa-fw mr-1"></i>{{$product->view_count}}
                                        </p>
                                    </div>
                                    <div class="">
                                        <p class="badge  p-2 " >
                                            <i class="fa fa-calendar-alt"></i> {{$product->created_at->format('D,M,Y')}}
                                        </p>
                                    </div>
                                </div>
                                <div class="my-2 px-5">
                                    <small>
                                        {{$product->description}}
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mr-5">
                                <a href="{{route('product_edit',$product->id)}}" class="btn btn-sm btn-outline-success mr-2">
                                    <i class="fa fa-edit fa-fw "></i> Edit
                                </a>
                                <form action="{{route('product_delete',$product->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash fa-fw "></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
