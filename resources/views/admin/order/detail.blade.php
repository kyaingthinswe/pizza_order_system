@extends('admin.layout.master')
@section('title','Order Detail')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <a href="{{route('order_list')}}" class="mt-4 text-decoration-none text-muted">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <div class="card ">

                            <div class="card-body">
                                <h4 class="mb-3 text-center"><i class="fa-solid fa-circle-info mr-2"></i>Order Info</h4>
                                <div class="d-flex  mb-2">
                                    <div class="col-6">
                                        <i class="fa fa-user mr-1"></i>Name
                                    </div>
                                    <div class="text-uppercase ">{{$data[0]->user->name}}</div>
                                </div>
                                <div class="d-flex  mb-2">
                                    <div class="col-6">
                                        <i class="fa-solid fa-barcode mr-1"></i>Order Code
                                    </div>
                                    <div class="text-uppercase ">{{$data[0]->order_code}}</div>
                                </div>
                                <div class="d-flex  mb-2">
                                    <div class="col-6">
                                        <i class="fa-solid fa-calendar-days mr-1"></i>Order Date
                                    </div>
                                    <div class="text-uppercase ">{{$data[0]->created_at->format('d-M-Y')}}</div>
                                </div>
                                <div class="d-flex  mb-2">
                                    <div class="col-6">
                                        <i class="fa-solid fa-money-bill-wave mr-1"></i>Total
                                    </div>
                                    <div class=" ">
                                        {{$total}} Kyats <br>
                                        <small class="text-danger">(Including Delivery Charge <i class="fa-regular fa-face-laugh-wink ml-1"></i>)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 col-7">
                        <table class="table table-data2 ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th> Price</th>
                            </tr>
                            </thead>
                            <tbody class="statusList">
                            @forelse($data as $d)
                                <tr>
                                    <td style="vertical-align: middle">{{$d->id}}</td>
                                    <td>{{$d->product->name}}</td>
                                    <td>
                                        <img src="{{asset('storage/product/'.$d->product->image)}}" class="img-thumbnail" style="width: 100px;" alt="">
                                    </td>
                                    <td>{{$d->qty}}</td>
                                    <td>{{$d->total}}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td class="text-center" colspan="9">There is no Order</td>
                                </tr>
                            @endforelse

                            </tbody>

                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@stop
@push('script')
    <script>

    </script>
@endpush
