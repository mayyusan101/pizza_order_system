@extends('admin.layouts.master')

@section('title','Order List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{ route('order#listPage') }}" class="text-decoration-none mb-2">
                    <i class="fa-solid fa-arrow-left-long fs-5 text-dark " ></i><p class="d-inline text-dark  ms-1">Back</p>
                </a>
                <div class="card col-6">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="text-center title-2"><i class="fa-solid fa-clipboard-list me-1 text-info"></i>Order</h4>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <p><i class="fa-solid fa-user me-1"></i>Customer Name</p>
                            <p>{{ $orderList[0]->user_name }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-1"> 
                            <p><i class="fa-solid fa-barcode me-1"></i>Order Code</p>
                            <p class="text-primary">{{ $orderList[0]->order_code }}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <p><i class="fa-regular fa-clock me-1"></i>Order Date</p>
                            <p>{{ $orderList[0]->created_at->format('j-F-Y')}}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <p><i class="fa-solid fa-money-bill-1-wave me-1 text-success"></i>Total</p>
                            <div>
                                <p class="ms-5">{{ $order->total_price +3000}} kyats </p>
                            <small class="text-warning ms-2">(include deli charges)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2 mt-3">
                    <table class="table table-data2 text-center ">
                        <thead >
                            <tr>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                          @foreach ($orderList as $o)
                              <tr>
                                <td class="d-flex align-items-center" style="margin-top:25%">
                                    <div >{{ $o->id }}</div>
                                </td>
                                <td class="col-2">
                                    <img src="{{ asset('storage/'.$o->product_image) }}" alt="">
                                </td>
                                <td><span class="block-email">{{ $o->product_name }}</span></td>
                                <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                <td>{{ $o->quantity }} </td>
                                <td>{{ $o->total }} kyats</td>
                              </tr>
                              <tr class="spacer"></tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
               
                <div class="mt-2">
                    {{ $orderList->appends(request()->query())->links() }}
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection

