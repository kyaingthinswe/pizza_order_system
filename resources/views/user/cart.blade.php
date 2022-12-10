@extends('user.layout.master')
@section('title','cart')
@section('content')
<!-- Cart Start -->
<div class="container-fluid mt-3">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody class="align-middle" >
                @forelse($carts as $c)
                    <tr>

                        <td class="align-middle text-left pl-4">
                            <img src="{{asset('storage/product/'.$c->product->image)}}" class="img-thumbnail mr-2" style="width: 100px;" alt="">
                            {{$c->product->name}}
                            <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::id()}}" id="userId">
                            <input type="hidden" value="{{$c->product->id}}" id="productId">
                        </td>
                        <td class="align-middle" id="price">{{$c->product->price}} kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty" value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{$c->product->price * $c->qty}} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove" ><i class="fa fa-times"></i></button></td>
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
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotal">{{$total}} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{$total+3000}} kyats</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkoutBtn">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@stop
@push('script')
    <script>
        $(document).ready(function () {
            $('.btn-plus').click(function (e) {
                e.preventDefault();
                // console.log(e.target);
                $parentNote = $(this).parents("tr");
                $price = $parentNote.find("#price").html().replace("kyats","");
                $qty = $parentNote.find("#qty").val();
                // console.log($qty+" "+$price);
                $total =$price*$qty;
                $parentNote.find("#total").html($total+" kyats");

                total();

            });

            $('.btn-minus').click(function (e) {
                e.preventDefault();
                // console.log(e.target);
                $parentNote = $(this).parents("tr");
                $price = $parentNote.find("#price").html().replace("kyats","");
                $qty = $parentNote.find("#qty").val();
                // console.log($qty+" "+$price);
                $total =$price*$qty;
                $parentNote.find("#total").html($total+" kyats");

                total();
            });

            $('.btn-remove').click(function () {
                $parentNote = $(this).parents('tr');
                $parentNote.remove();
            });
            function total() {
                //SUBTOTAL
                $subTotal = 0;
                $('tbody tr').each(function (index,data) {
                    // console.log(index+"-"+data);
                    // console.log($(data).find("#total").html());
                    $subTotal += $(data).find('#total').html().replace("kyats","")*1;
                    // console.log($subTotal);
                    // console.log(typeof($subTotal)); //string ဖြစ်နေလို့ integer ပြောင်းချင်ရင် Number() || 1နဲ့ မြှောက်
                });
                $("#subTotal").html(`${$subTotal} kyats`);
                $("#finalPrice").html(`${$subTotal+3000} kyats`);
            }

            //checkoutBtn
            $('#checkoutBtn').click(()=>{

                $orderCode = Math.floor(Math.random()*1000001);
                $data = [];
                $('tbody tr').each(function (index,row) {
                    // console.log($row);
                    $data.push({
                        user_id : $(row).find('#userId').val(),
                        product_id : $(row).find('#productId').val(),
                        qty : $(row).find('#qty').val(),
                        total :$total = $(row).find('#total').html().replace('kyats','')*1,
                        order_code : "POS"+$orderCode,
                    });
                    // console.log($data);
                    // console.log(typeof ($data[0].total))
                });
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/orderList',
                    data : Object.assign({},$data),
                    dataType : 'json',
                    success : function (response) {
                        if (response.status == 200){
                            location.href = 'http://127.0.0.1:8000/user/home';
                        }

                    }
                })
            });

        })
    </script>
@endpush
