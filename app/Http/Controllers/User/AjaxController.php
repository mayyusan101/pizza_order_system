<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){

        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }
    //get data from <button>add to cart</button> Button
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'added to cart',
            'success' => 'true',
        ];
        return response()->json($response, 200);
    }
    //proceed checkout function
    public function checkOut(Request $request){

        $total = 0; $orderCode = 0;
        foreach($request->all() as $item){
            $orderCode = $item['order_code'];
            $total += $item['total']; 
            OrderList::create($item);
       }
       Cart::where('user_id',Auth::user()->id)->delete();  //delete cart after order

       Order::create([
        'user_id' => Auth::user()->id,
        'order_code' => $orderCode,
        'total_price' => $total,
       ]);

       $data = ['message' => 'order success','status' => 'true'];
       return response()->json($data, 200);
    }

    //clear current product
    public function deleteCart(Request $request){
        Cart::where('id',$request->cart_id)->delete();  

        return response()->json([
            'message' => 'delete success'
        ], 200, );
    }
    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'message' => 'delete success'
        ], 200, );
    }


    //get order data 
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->count,
        ];
    }
}
