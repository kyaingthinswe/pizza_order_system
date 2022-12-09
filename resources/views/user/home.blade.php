@extends('user.layout.master')
@section('title','home page')
@section('content')
    @include('user.layout.sidebar')
    <!-- Shop Product Start -->
    <div class="col-lg-9 col-md-8 px-0">
        <div class="row pb-3">
            <div class="col-12 pb-2">
                <div class="d-flex align-items-center justify-content-between ">
                    <a href="{{route('user_cartList')}}" class="btn btn-sm btn-dark text-primary position-relative rounded text-decoration-none">
                        <i class="fa fa-cart-plus fa-fw"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-dark ">
                            {{count($carts)!=0 ? count($carts):""}}
                        </span>
                    </a>
                    <div class="ml-2">
                        <div class="btn-group">
                            <select name="sorting" class="form-control border-0 " id="eventOption">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div id="productBox" class="w-100 row px-2" >
                @forelse($products as $p)
                    <div class="col-lg-4 col-md-6" id="productBox" >
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/product/'.$p->image) }}" style="height: 220px;" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user_detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$p->price}} kyats</h5><h6 class="text-muted ml-2"><del>{{$p->price}}</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="ml-5">
                        <h4 class="p-3 shadow">There is no pizza <i class="fa-solid fa-pizza-slice"></i></h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Shop Product End -->
    @stop
@push('script')
    <script>
        $(document).ready(function () {
            // $.ajax({
            //     type: 'get',
            //     url: 'http://localhost:8000/user/sorting',
            //     dataType: 'json',
            //     success: function (response) {
            //         console.log(response);
            //     }
            // });
            $('#eventOption').change(function () {
                $eventOption = $('#eventOption').val();
                // console.log($eventOption);
                if ($eventOption == 'desc'){
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/sorting',
                        // headers: {  'Access-Control-Allow-Origin': 'http://localhost:8000/user/sorting' },
                        data : {'status' : 'desc'},
                        dataType: 'json',
                        success: function (response) {
                            $list = '';
                            console.log(response);
                            for($i=0;$i<response.length;$i++){
                                // console.log(response[$i].image);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                        <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/product/${response[$i].image}') }}" style="height: 220px;" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price}</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                `;
                                // console.log($list);
                                $('#productBox').html($list);
                            }
                        }
                    });
                }else{
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/sorting',
                        dataType: 'json',
                        data : {'status' : 'asc'},
                        success: function (response) {
                            $list = '';
                            // console.log(response);
                            for($i=0;$i<response.length;$i++){
                                // console.log(response[$i].image);
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                        <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/product/${response[$i].image}') }}" style="height: 220px;" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price}</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                `;
                                // console.log($list);
                                $('#productBox').html($list);
                            }
                        }

                    });
                }
            })
        })
    </script>
@endpush
