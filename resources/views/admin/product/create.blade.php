@extends('admin.layout.master')
@section('title','product create')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h3 class="text-center title-2">Create Product</h3>
                                <div>
                                    <a href="{{route('product_list')}}">
                                        <button class="btn btn-sm btn-outline-dark  my-3">
                                            <i class="fa fa-list fa-fw"></i>List
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <form action="{{route('product_store')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="productName" class="control-label mb-1">Name</label>
                                    <input id="productName" value="{{old('productName')}}" name="productName" type="text" class="form-control @error('productName')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('productName')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productName" class="control-label mb-1">Category</label>
                                    <select name="categoryId" class="form-control ">
                                        <option value="">Choose one ...</option>
                                        @foreach($categories as $c)
                                            <option value="{{$c->id}}" >{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productDescription" >Description</label>
                                    <textarea  name="productDescription" type="text" class="form-control @error('productDescription')is-invalid @enderror"  cols="30" rows="5" >
                                        {{old('productDescription')}}
                                    </textarea>
                                    @error('productDescription')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productImage" class="control-label mb-1">Image</label>
                                    <input id="productImage" value="{{old('productImage')}}" name="productImage" type="file" class="form-control @error('productImage')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                    @error('productImage')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productPrice" class="control-label mb-1">Price</label>
                                    <input id="productPrice" value="{{old('productPrice')}}" name="productPrice" type="number" class="form-control @error('productPrice')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                    @error('productPrice')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                    <input id="waitingTime" value="{{old('waitingTime')}}" name="waitingTime" type="text" class="form-control @error('waitingTime')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time...">
                                    @error('waitingTime')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <button  type="submit" class="btn btn-lg w-100 btn-success ">
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
