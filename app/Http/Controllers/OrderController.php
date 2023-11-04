<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLi;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order lists page
    public function listPage(){

        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->orderBy('orders.created_at','desc');
 
            if(request('searchKey')){
            $order =  $order->where('order_code','like','%'.request('searchKey').'%')
                            ->paginate(4);
            }else{
            $order =  $order->paginate(4);
            }

        return view('admin.order.list',compact('order'));
    }

    //sorting status by option 
    public function statusSort(Request $request){
  
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->orderBy('orders.created_at','desc');

        $order = ($request->statusOption == null)? 
                $order->paginate(4)  :                                        //for all
                $order->where('orders.status',$request->statusOption)   //for option
                 ->paginate(4) ;      

        return view('admin.order.list',compact('order'));
    }
    //change status
    public function changeStatus(Request $request){

       Order::where('id',$request->id)->update([
        'status' => $request->status
       ]);

       $data = ['message' => 'change status'];
       return response()->json($data, 200);
    }
    
}
