<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($productId){

        $product = Product::where('id',$productId)->get();
        $data = $this->getOneProductData($product,$productId);
       
        Cart::create($data);
        return back();
    }

    //add one product to cart from home page
    private function getOneProductData($product,$productId){

        return [
            'user_id' => Auth::user()->id,
            'product_id' => $productId,
            'quantity' => 1,
        ];
    }
}
