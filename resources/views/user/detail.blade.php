@extends('user.layout.master')
@section('title','detail page')
@section('content')

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">

        <div class="row px-xl-5">

            <div class="col-lg-5 mb-30 d-flex flex-column">
                <a href="{{route('user_home')}}" class="text-decoration-none text-muted mb-2">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
                <img src="{{asset('storage/product/'.$product->image)}}" class="img-thumbnail" style="height: 350px;" alt="">
            </div>

            <div class="col-lg-7 h-auto mb-30 p-0 shadow-sm  "  >
                <div class="h-100 bg-light p-30 " >
                    <input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{Auth::id()}}"  id="userId">
                    <input type="hidden" class="form-control bg-secondary border-0 text-center" value="{{$product->id}}" id="productId">
                    <h3>{{$product->name}}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">
                            {{$product->view_count}}<i class="fa fa-eye fa-fw ml-1"></i>
                        </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product->price}} kyats</h3>
                    <p class="mb-4">{{$product->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>

                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" max="20" id="productItem">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addBtn">
                            <i class="fa fa-shopping-cart mr-1"></i> Add ToCart
                        </button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid pb-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($products as $p)
                    <div class="product-item bg-light shadow-sm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('storage/product/'.$p->image)}}" style="height: 250px;" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user_detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h5 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6>{{$p->price}} Kyats</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@stop
@push('script')
    <script>
        $(document).ready(function () {
            $('#addBtn').click(function () {
                $source = {
                    'userId' : $('#userId').val(),
                    'productId' : $('#productId').val(),
                    'productItem' : $('#productItem').val(),
                };
                // console.log($source);
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/addToCart',
                    data : $source,
                    dataType : 'json',
                    success : function (response) {
                        console.log(response.status);
                        if (response.status == 200){
                            // location.href = 'http://127.0.0.1:8000/user/home';
                            alert('Your order is confirmed ...');
                        }
                    }
                })
            });


        })
    </script>
@endpush
