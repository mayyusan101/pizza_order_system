<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RouteController extends Controller
{
    //category list api
    public function categoryList(){
        $data = Category::orderBy('id','desc')->get();
        return response()->json($data, 200);
    }
    //product list api
    public function productList(){
        $data = Product::orderBy('id','desc')->get();
        return response()->json($data, 200);
    }
    // contact list
    public function contactList(){
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }
    //order list api
    public function orderList(){
        $data = orderList::orderBy('id','desc')->get();
        return response()->json($data, 200);
    }
    //list all
    public function listAll(){

        $data = [
            'product' => Product::get(),
            'category' => Category::get(),
            'user' => User::where('role','user')->get()
        ];
        return response()->json($data, 200);
    }

    //read category with GET
    public function readCategory($category_id){

        $data = Category::where('id',$category_id)->first();

        if(isset($data)){

            return response()->json(['status' => true ,'data' => $data], 200);
        }
        return response()->json(['status' => false ,'message' => 'there is no category at '.$category_id], 500);
    }
    //read category with POST
    public function readCategory1(Request $request){
        return $request->header('age');
        $data = Category::find($request->category_id);

        if(isset($data)){

            $response = Category::where('id',$request->category_id)->first();
            return response()->json(['status' => true , 'data' => $response], 200);
        }
        return response()->json(['status' => false ,'message' => 'there is no category at '.$request->category_id], 500);
    }
    //create category
    public function createCategory(Request $request){

        Category::create([
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

       return response()->json(['status' => true , 'message' => 'create success'], 200);
    }
    //create contact
    public function createContact(Request $request){

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        return response()->json(['status' => true , 'message' => 'create success'], 200);
    }
    //create user
    public function createUser(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['status' => true , 'message' => 'create success'], 200);
    }

    //delete category with GET
    public  function deleteCategory($id){

        $data = Category::find($id);

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true , 'message' => 'delete success','deleted' => $data], 200);
        };
        return response()->json(['status' => false , 'message' => 'category id not found..'], 500);
    }

    public  function deleteContact($id){

        $data = Contact::find($id);

        if(isset($data)){
            Contact::where('id',$id)->delete();
            return response()->json(['status' => true , 'message' => 'delete success','deleted' => $data], 200);
        };
        return response()->json(['status' => false , 'message' => 'contact id not found..'], 500);
    }

    //delete category with POST
    public function deleteCategory1(Request $request){

        $data = Category::find($request->id);

        if(isset($data)){
            Category::where('id',$request->id)->delete();
            return response()->json(['status' => true , 'message' => 'delete success','deleted' => $data], 200);     
        }
        return response()->json(['status' => false , 'message' => 'category id not found..'], 500);
    }

    public function deleteContact1(Request $request){

        $data = Contact::find($request->id);
        
        if(isset($data)){
            Contact::where('id',$request->id)->delete();
            return response()->json(['status' => true , 'message' => 'delete success','deleted' => $data], 200);
        }
        return response()->json(['status' => false , 'message' => 'contact id not found..'], 500);
    }

    //update category
    public function updateCategory(Request $request){

        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->update([
                'name' => $request->name,
                'updated_at' => Carbon::now()
            ]);
            $response = Category::find($request->category_id);
            return response()->json(['status' => true , 'message' => 'update success','updated' => $response], 200);
        }
        return response()->json(['status' => false , 'message' => 'category id not found..'], 500);
    }

}
