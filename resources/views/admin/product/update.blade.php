@extends('admin.layout.master')
@section('title','product update')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h3 class="text-center title-2">Update Product</h3>
                                <div>
                                    <a href="{{route('product_list')}}">
                                        <button class="btn btn-sm btn-outline-dark  my-3">
                                            <i class="fa fa-list fa-fw"></i>List
                                        </button>
                                    </a>
                                </div>
                            </div>
                                <div class="position-relative d-flex justify-content-center mb-3 "  style="margin: auto; width: 100%;">
                                    @if($product->image != null)
                                        <button class="btn btn-secondary btn-sm position-absolute edit-btn " style="bottom:10px; right: 10px;  " >
                                            <i class="fa fa-edit fa-fw "></i>
                                        </button>
                                    @endif
                                    <img src="{{asset('storage/product/'.$product->image)}}" class="product-image w-100"  alt="">
                                </div>
                            <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf

                                <input id="product-image-input" value="{{old('productImage',$product->image)}}" name="productImage" type="file" hidden class="form-control  @error('productImage')is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('productImage')
                                <div class="invalid-feedback">
                                    <strong class="text-danger">{{$message}}</strong>
                                </div>
                                @enderror
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <div class="form-group">
                                    <label for="productName" class="control-label mb-1">Name</label>
                                    <input id="productName" value="{{old('productName',$product->name)}}" name="productName" type="text" class="form-control @error('productName')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
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
                                            <option value="{{$c->id}}" {{$product->category_id == $c->id ? 'selected': ''}} >{{$c->name}}</option>
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
                                        {{old('productDescription',$product->description)}}
                                    </textarea>
                                    @error('productDescription')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productPrice" class="control-label mb-1">Price</label>
                                    <input id="productPrice" value="{{old('productPrice',$product->price)}}" name="productPrice" type="number" class="form-control @error('productPrice')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                    @error('productPrice')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                    <input id="waitingTime"  value="{{old('waitingTime',$product->waiting_time)}}" name="waitingTime" type="text" class="form-control @error('waitingTime')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time...">
                                    @error('waitingTime')
                                    <div class="invalid-feedback">
                                        <strong class="text-danger">{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <button  type="submit" class="btn btn-lg w-100 btn-success ">
                                        <span id="payment-button-amount">
                                            Update
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
@push('script')

<script>
    let editBtn = document.querySelector('.edit-btn');
    let productImage = document.querySelector('.product-image');
    let productImageInput = document.querySelector('#product-image-input');
    editBtn.addEventListener('click',function () {
        productImageInput.click();
    });
    productImageInput.addEventListener('change',function () {
        let reader = new FileReader();
        // console.log(reader);
        let file = productImageInput.files[0];
        reader.onload = function () {
            productImage.src = reader.result;
        };
        reader.readAsDataURL(file);

    });
</script>


@endpush
