@extends('user.layout.master')
@section('title','cart')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid my-3" style="height: 350px;">
        <div class="row px-xl-5 " >
            <div class="col-lg-8 m-auto table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>Time</th>
                        <th>Product</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle" >
                    @forelse($orders as $order)
                    <tr>
                        <td>{{$order->created_at->diffForHumans()}}</td>
                        <td>{{$order->order_code}}</td>
                        <td>{{$order->total_price}} Kyats</td>
                        <td>
                            @if($order->status == 0)
                                <p class="text-warning">
                                    <i class="fa-solid fa-spinner"></i> Pending
                                </p>
                            @elseif ($order->status == 1)
                                <p class="text-success">
                                    <i class="fa-regular fa-circle-check mr-1"></i>Accept
                                </p>
                            @else
                                <p class="text-danger">
                                    <i class="fa-solid fa-triangle-exclamation mr-1 "></i>Reject
                                </p>
                            @endif
                        </td>

                    </tr>
                    @empty
                        <tr >
                            <td class="h4 text-primary bg-dark text-center" colspan="5">
                                There is no order
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
                <div class="mt-2">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@stop
@push('script')
    <script>

    </script>
@endpush
