<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct list page
    public function listPage(){

        $categories = Category::when(request('searchKey'),function($query){
                        $query->where('name','like','%'.request('searchKey').'%');
                        })  
                        ->orderBy('id','desc')
                        ->paginate(4);
     
        return view('admin.category.list',compact('categories'));
    }
    //direct create page
    public function createPage(){
        return view('admin.category.create');
    }
    //create Categorise 
    public function create(Request $request){
        
        $this->validationCheck($request);
        $data = $this->getCategoryData($request);
        Category::create($data);
        return redirect()->route('category#listPage');
    }
    //delete Category
    public function delete($id){

        $category_name = Category::select('name')->where('id',$id)->first();
        $category_name = $category_name['name'];
        Category::where('id',$id)->delete();
        return back()->with(['delete_message' => 'is deleted !' ,'name' => $category_name]);
    }

    //direct update page
    public function updatePage($id){

        $category = Category::where('id',$id)->first();
        return view('admin.category.update',compact('category'));
    }
    //update Category
    public function update(Request $request,$id){
        
        $request->id = $id;
      
        $this->validationCheck($request);
        $data = $this->getCategoryData($request);
        Category::where('id',$id)->update($data);

        return redirect()->route('category#listPage');
    }
    
    //category validation check
    private function validationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->id,
        ])->validate();
    }

    //get category array data
    private function getCategoryData($request){
        $data = [
            'name' =>  $request->categoryName,
        ];
        return $data;
    }
}
