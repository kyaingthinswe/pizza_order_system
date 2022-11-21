@extends('admin.layout.master')
@section('title','category create')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
{{--                <div class="row">--}}
{{--                    <div class="col-3 offset-8">--}}
{{--                        <a href="category_list.html"><button class="btn bg-dark text-white my-3">List</button></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h3 class="text-center title-2">Create Category</h3>
                                <div>
                                    <a href="{{route('category_list')}}">
                                        <button class="btn btn-sm btn-outline-dark  my-3">
                                            <i class="fa fa-list fa-fw"></i>List
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <form action="{{route('category_store')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="categoryName" class="control-label mb-1">Name</label>
                                    <input id="categoryName" value="{{old('categoryName')}}" name="categoryName" type="text" class="form-control @error('categoryName')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('categoryName')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">
                                            Create
                                        </span>
                                    </button>
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