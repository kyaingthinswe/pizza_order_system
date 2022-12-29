@extends('admin.layout.master')
@section('title','Order List')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between px-1">
                        <h3 class="my-auto text-muted">
                            <i class="fa-solid fa-database mr-1"></i>Total : {{count($orders)}}
                        </h3>
                        <form action="{{route('order_statusList')}}" method="get" class="d-flex col-3">
                            @csrf
                            <select name="orderStatus"  class="form-control status-list"  >
                                <option value="" >All</option>
                                <option value="0" {{request()->orderStatus == '0' ? 'selected':''}}>Pending</option>
                                <option value="1" {{request()->orderStatus == '1' ? 'selected':''}}>Accept</option>
                                <option value="2" {{request()->orderStatus == '2' ? 'selected':''}}>Reject</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    {{--                show status--}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            <p>{{session('status')}}</p>
                        </div>
                    @endif


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th> Order Code</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="statusList">
                            @forelse($orders as $order)
                                <tr>
                                    <td class="order-id">{{$order->id}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>
                                        <a href="{{route('order_detail',$order->order_code)}}" data-toggle="tooltip" data-placement="top" title="View Details">
                                            {{$order->order_code}}
                                        </a>
                                    </td>
                                    <td>{{$order->total_price}} kyats</td>
                                    <td>{{$order->created_at->format('d-F-Y')}}</td>
                                    <td >
                                        <select name="status"  class="form-control w-75 status-btn"  >
                                            <option value="0"  {{$order->status == 0 ? 'selected': ''}} >Pending</option>
                                            <option value="1"  {{$order->status == 1 ? 'selected': ''}}>Accept</option>
                                            <option value="2"  {{$order->status == 2 ? 'selected': ''}}>Reject</option>
                                        </select>
                                    </td>
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
        $(document).ready(function () {
            // $('.status-list').change(function () {
            //     $statuslist = $(this).val();
            //     // console.log($statuslist);
            //     $dataList = {
            //         'status' : $statuslist,
            //     }
            //     // $statusBtn = $('.status-btn').val();
            //     // $parentNote = $statusBtn.parents('tr');
            //     // $orderId = $parentNote.find('.order-id').html();
            //     $.ajax({
            //         type : 'get',
            //         url : 'http://127.0.0.1:8000/order/status/list',
            //         dataType : 'json',
            //         data : $dataList,
            //         success : function (response) {
            //             // console.log(response);
            //             $list = "";
            //             for($i=0;$i<response.length; $i++){
            //                 console.log(response[$i].status);
            //
            //                 $list += `
            //                     <tr>
            //                         <td class="order-id">${response[$i].id}</td>
            //                         <td>${response[$i].user_name}</td>
            //                         <td>${response[$i].order_code} </td>
            //                         <td>${response[$i].total_price} kyats</td>
            //                         <td>hello</td>
            //                         <td>
            //                             <select name="status"  class="form-control w-75 status-btn"  >
            //                                 <option value="0" ${response[$i].status == 0 ? "selected" : " "}>Pending</option>
            //                                 <option value="1" ${response[$i].status == 1 ? "selected" : " "}>Accept</option>
            //                                 <option value="2" ${response[$i].status == 2 ? "selected" : " "}>Reject</option>
            //
            //                             </select>
            //                         </td>
            //                     </tr>
            //                 `;
            //             }
            //             // console.log($list);
            //             $('.statusList').html($list);
            //         }
            //     });
            //     statusChange();
            //
            // });

            $('.status-btn').change(function () {
                    console.log('change');
                    $status = $(this).val();
                    $parentNote = $(this).parents('tr');
                    $orderId = $parentNote.find('.order-id').html();
                    $data = {
                        'status' : $status,
                        'orderId' : $orderId,
                    }
                    $.ajax({
                        type : 'get',
                        url : '/order/status/change',
                        dataType : 'json',
                        data : $data,
                        success : function (response) {
                            window.location.href = "/order/list";
                            // console.log(response);
                        }

                    });
                });



        })
    </script>
    @endpush
