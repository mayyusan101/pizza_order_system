<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    //diredt one order list info 
    public function listInfo($orderCode){
        
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                                ->leftJoin('users','users.id','order_lists.user_id')
                                ->leftJoin('products','products.id','order_lists.product_id')
                                ->where('order_lists.order_code',$orderCode)
                                ->paginate(4);

        return view('admin.order.orderList',compact('orderList','order'));
    }
}
