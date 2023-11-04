@extends('admin.layouts.master')

@section('title','Order Lists')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-20px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
                        </div>
                    </div>
                    <div class=" col-3">
                        <form action="{{ route('order#listPage') }}" method="get" class="d-flex">
                            <input type="text" name="searchKey" id="" class="form-control" value="{{ request('searchKey') }}" placeholder="POS. . . . . . . . .">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="col-9">
                        <form action="{{ route('order#sort') }}" method="get">
                            <div class="d-flex align-items-center mb-3 ">
                                <div><h4 class="d-inline text-primary me-2 text-danger"> Status :</h4></div>
                                <select name="statusOption" id="statusOption" class="form-select col-3 me-2 " >
                                    <option value="" @if(request('statusOption') == "") selected @endif>All</option>
                                    <option value="0" @if(request('statusOption') == '0') selected @endif>Pending</option>
                                    <option value="1" @if(request('statusOption') == '1') selected @endif>Success</option>
                                    <option value="2" @if(request('statusOption') == '2') selected @endif>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-sm bg-dark text-white me-2"><i class="fa-brands fa-searchengin"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="float-end">
                        <h3 class="text-info">Total - <span>{{ $order->total() }}</span></h3>
                    </div>
                </div>
                
                @if ($order->total() !=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center ">
                        <thead >
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow " id="parent">
                                <input type="hidden" class="orderId" value="{{ $o->id }}">
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td><a href="{{ route('order#listInfo',$o->order_code) }}">{{ $o->order_code }}</a></td>
                                <td class="dateTime">{{ $o->created_at->format('F-j-Y') }}</td>
                                <td>{{ $o->total_price }} kyats</td>
                                <td class="p-0 me-1" class="col-10">
                                    <select id="status" class="form-control col-10 changeStatus">
                                        <option value="0" @if ($o->status == '0') selected @endif >Pending</option>
                                        <option value="1"  @if ($o->status == '1') selected @endif >Success</option>
                                        <option value="2"  @if ($o->status == '2') selected @endif >Reject</option>
                                    </select>
                                </td>                     
                            </tr> 
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->  
                @else
                    <div class="d-flex justify-content-center mt-5">
                        <h2 class="text-secondary mt-3">There is no order </h2>
                    </div> 
                @endif
               
                <div class="mt-2">
                    {{ $order->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptContent')
<script>
    $(document).ready(function(){

    $('.changeStatus').change(function(){

        $parentNode = $(this).parents("tr");
        $orderId = $parentNode.find('.orderId').val();

        $status = $parentNode.find('#status').val();

            $.ajax({
                type : 'get',
                url  : '/order/change/status',
                data : {
                    'status' : $status,
                    'id'     : $orderId,
                },
                dataType : 'json',
                success  : function(response){
                   
                }
            })
            location.reload();
        })

    // $('#statusOption').change(function(){
    
    //     $statusOption = {'statusOption' : $('#statusOption').val()};

    //     $.ajax({
    //         type : 'get',
    //         url  : 'http://localhost:8000/order/status/sorting',
    //         data : $statusOption,
    //         dataType : 'json',
    //         success : function(response){

    //             $list = "";
    //             for (let $i = 0; $i < response.length; $i++) {

    //                 $dbDate = new Date(response[$i].created_at);
    //                 //2022-09-23T07:30:42.000000Z
    //                 //September-23-2022
    //                 $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];  
    //                 $date = $month[$dbDate.getMonth()] +'-' +$dbDate.getDate() +'-' +$dbDate.getFullYear();
                
    //                 $selectBox = "";
    //                if(response[$i].status == 0){

    //                 $selectBox = `
    //                                 <select  id="status" class="form-control col-10 changeStatus">
    //                                     <option value="0" selected>Pending</option>
    //                                     <option value="1" >Success</option>
    //                                     <option value="2" >Reject</option>
    //                                 </select>
    //                 `
    //                }else if(response[$i].status == 1){
    //                 $selectBox = `
    //                                 <select  id="status" class="form-control col-10 changeStatus">
    //                                     <option value="0" >Pending</option>
    //                                     <option value="1" selected >Success</option>
    //                                     <option value="2" >Reject</option>
    //                                 </select>
    //                 `
    //                }else if(response[$i].status == 2){
    //                 $selectBox = `
    //                                 <select  id="status" class="form-control col-10 changeStatus">
    //                                     <option value="0" >Pending</option>
    //                                     <option value="1" >Success</option>
    //                                     <option value="2" selected >Reject</option>
    //                                 </select>
    //                 `
    //                }
    //                 $list += `
    //                             <tr class="tr-shadow ">
    //                                 <td>${response[$i].id}</td>
    //                                 <td>${response[$i].user_name}</td>
    //                                 <td>${response[$i].order_code}</td>
    //                                 <td>${$date}</td>
    //                                 <td>${response[$i].total_price}kyats</td>
    //                                 <td class="p-0 me-1">${$selectBox}</td>

    //                                 <input type="hidden" class="orderId" value="${response[$i].id}">
    //                             </tr> 
                                
    //                             <tr class="spacer"></tr>
    //                         `;
    //             }

    //             $('#dataList').html($list);
    //              location.load();
    //         }
    //     })


    // })
})
</script>
@endsection
