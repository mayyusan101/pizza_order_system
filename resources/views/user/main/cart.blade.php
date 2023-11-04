@extends('user.layouts.master')

@section('title','My Cart')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="col-3">Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle tbody">
                        @foreach ($cart as $c)
                        <tr>
                            <td><img src="{{ asset('storage/'.$c->product_image) }}" alt="" style="width: 50px;"></td>
                            <td class="align-middle"> {{ $c->product_name }}</td>
                            <td class="align-middle " id="productPrice">{{ $c->product_price }} kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus btnClick" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="productQty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->quantity }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus btnClick">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="productId" value="{{ $c->product_id }}">
                                <input type="hidden" id="cartId" value="{{ $c->id }}">
                            </td>
                            <td class="align-middle " id="total">{{ $c->product_price * $c->quantity }} kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 >Subtotal</h6>
                            <h6 id="subTotal">{{ $total }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalSummary">{{ $total + 3000 }} kyats</h5>
                        </div>
                        <button class="orderBtn btn btn-block btn-success text-white font-weight-bold  my-3 py-3"><span class="text-white">Proceed To Checkout</span></button>
                        
                        <button class="clearCartBtn btn btn-block btn-danger  font-weight-bold my-3 py-3"><span class="text-white">Clear Cart</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

   
@endsection

@section('scriptContent')
<script>
$(document).ready(function(){

    //btn for plus and minus quantity
    $('.btnClick').click(function(){

        $parentNode = $(this).parents("tr");
        $perPrice = Number($parentNode.find('#productPrice').html().replace('kyats',''));//get price value
        $quantity = Number($parentNode.find('#productQty').val());
        $parentNode.find('#total').html($perPrice*$quantity + 'kyats');

        summaryCulcation();
    })
    //btn for remove
    $('.btnRemove').click(function(enent){
        $parentNode = $(event.target).parents("tr");  //$(this) == $(enent.target)
        $parentNode.remove();

        summaryCulcation();
        
        $cartId = $parentNode.find('#cartId').val();    //get unique key 
        $.ajax({
            type : 'get',
            url  : '/user/ajax/delete/current/product/cart',
            data : {'cart_id' : $cartId},
            dataType : 'json',
        })

    })
    //claculate for total summary at side bar
    function summaryCulcation(){

        $summary_total = 0;

        $('.tbody tr').each(function(index,row){        //(parent > children) row means each child
                
            $summary_total += Number($(row).find('#total').html().replace('kyats',''));
        });
        $('#subTotal').html($summary_total + 'kyats');
        $('#totalSummary').html(`${$summary_total+3000} kyats`);
    }

    $('.orderBtn').click(function(){
    
        $list = [];
        $orderCode = Math.floor(Math.random() * 10000001);
        $('.tbody tr').each(function(index,row){

        $list.push({
            'user_id'   : $(row).find('#userId').val(),
            'product_id': $(row).find('#productId').val(),
            'quantity'  : Number($(row).find('#productQty').val()),
            'total'     :  Number($(row).find('#total').html().replace('kyats','')),
            'order_code': 'POS' + $orderCode
        });

        });
        
        $.ajax({
            type : 'get',
            url  :  '/user/ajax/process/checkOut',
            data : Object.assign({},$list),
            dataType : 'json',
            success : function(response){
    
                if(response.status == 'true'){
                    window.location.href = '/user/homePage';
                }
            }
        })  
    });

    $('.clearCartBtn').click(function(){
        $.ajax({
            type : 'get',
            url  : '/user/ajax/clear/cart',
            dataType : 'json',
            success : function(response){
                if(response.message){
                    window.location.href = '/user/homePage';
                }
            }
        })
    })
   
    $('#titleCart').addClass("active");
})
</script>
@endsection
