<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user home page
    public function homePage(){

        $categories = Category::orderBy('created_at','desc')->get();
        $products = Product::get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('categories','products','cartList','orders'));
    }
    //direct home page for filter by Categories
    public function filterBy($id){
        
        $categories = Category::get();
        $products = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $cartList = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('categories','products','cartList','orders'));
    }
    //direct detail page
    public function detailPage($pizzaId){

        $viewCount = Product::where('id',$pizzaId)->first()->view_count;
        $viewCount +=1;
        Product::where('id',$pizzaId)->update([
            'view_count' => $viewCount
        ]);
        $pizza = Product::where('id',$pizzaId)->first();    //pizza for customer choice
        $pizzas = Product::get();                           //pizzas for suggestion
        return view('user.main.detail',compact('pizza','pizzas'));
    }
    //direct cart page
    public function cartPage(){
        
        $cart = Cart::where('carts.user_id',Auth::user()->id)
                    ->select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->orderBy('created_at','desc')
                    ->get();
        $total = 0;
        foreach ($cart as $c) {
            $total += $c->product_price * $c->quantity;
        }
        return view('user.main.cart',compact('cart','total'));
    }
    //direct  history page
    public function historyPage(){

        $orders = Order::where('user_id',Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->paginate(4);
        return view('user.main.history',compact('orders'));
    }

    //direct password_change_page
    public function changePasswordPage(){
        return view('user.account.changePassword');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $db_oldPassword = $user->password;
        
        if(Hash::check($request->oldPassword , $db_oldPassword)){
           $data = [
            'password' => Hash::make($request->newPassword)
           ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess' => 'Successfully changed password']);
        }
        return back()->with(['notMatch' => 'Your old password is not Match.Please try again..']);
    }
    //direct user profile page
    public function profilePage(){

        return view('user.account.profile');
    }
    //profile change
    public function profileChange(Request $request){

        $this->personalValidationCheck($request);
        $data = $this->getPersonalData($request);
        if($request->hasFile('image')){
            if(Auth::user()->image != null){
                $oldFileName  =  Auth::user()->image;
                Storage::delete('public/'.$oldFileName);
            }
            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['updateSuccess' => 'Your Information is updated']);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required | min:6 ',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword',
        ])->validate();
    }
    //personal validation check
    private function personalValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpeg,jpg,webg',
        ])->validate();
    }
    //get profile data 
    private function getPersonalData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }
}
