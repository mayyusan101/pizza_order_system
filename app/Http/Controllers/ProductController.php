<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct list page
    public function listPage(){

        $pizzas = Product::when(request('searchKey'),function($q){
                    $q->where('products.name','like','%'.request('searchKey').'%');
                    })
                    ->select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->orderBy('products.created_at','desc')
                    ->paginate(3);
        return view('admin.product.list',compact('pizzas'));
    }
    //direct create page
    public function createPage(){

        $categories = Category::select('id','name')->get();     
        return view('admin.product.create',compact('categories'));
    }
    //product create
    public function create(Request $request){
        
        $this->productValidationCheck($request,'create');
        $data = $this->getProductData($request);

        $imgName = uniqid() .$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$imgName);
        $data['image'] = $imgName;

        Product::create($data);
        return redirect()->route('product#listPage');
    }
    //direct view page
    public function viewPage($id){

        $pizza = Product::select('products.*','categories.name as category_name')
                        ->join('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
        return view('admin.product.detail',compact('pizza'));
    }
    //direct edit page
    public function updatePage($id){

        $pizza = Product::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.product.edit',compact('pizza','categories'));
    }
    //update
    public function update($id,Request $request){
        
        $this->productValidationCheck( $request ,'update');
        $data = $this->getProductData($request);

        if($request->hasFile('pizzaImage')){
            $oldImage = Product::select('image')->where('id',$id)->first();
            $oldImage = $oldImage['image'];
        if($oldImage != null){
                Storage::delete('public/' .$oldImage);
        }
            $imgName = uniqid() .$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$imgName);
            $data['image'] = $imgName;
        }
        Product::where('id',$id)->update($data);

        return redirect()->route('product#viewPage',$id)->with(['update' => 'Update success']);
    }
    //delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->back();
    }
    
    //product validation check
    private function productValidationCheck($request ,$status){

        $validationRules = [
            'pizzaName' => 'required | min:5',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            // 'pizzaImage' => 'required | mimes:png,jpg,jpeg,wepg',
            'waitingTime' => 'required',
            'price' => 'required',
        ];
        //check for create => need required but for update => no required
        $validationRules['pizzaImage'] = $status == 'create' ? 'required | mimes:png,jpg,jpeg,wepg' :'mimes:png,jpeg,wepg';
        Validator::make($request->all(),$validationRules)->validate();
    }

    //get product data
    private function getProductData($request){
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->waitingTime,
            'price' => $request->price,
        ];
    }
}
