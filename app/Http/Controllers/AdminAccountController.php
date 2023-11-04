<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAccountController extends Controller
{
    //direct page to change password
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){

        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $hashPassword = $user->password;

        if(Hash::check($request->oldPassword ,$hashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

        // Auth::logout();
           return back()->with(['changeSuccess' => 'Successfully changed password']);
        }
        return back()->with(['notMatch' => 'Your old password is not Match.Please try again..']);
    }

    //direct personal detail page
    public function detailPage(){
        return view('admin.account.detail');
    }

    //direct personal edit detail page
    public function editDetailPage(){
        return view('admin.account.editDetail');
    }

    //update personal detail
    public function updateDetail(Request $request){

        $this->personalValidationCheck($request);
        $data = $this->getPersonalData($request);

        if($request->hasFile('image')){
            if(Auth::user()->image != null){
                $oldImage_name = Auth::user()->image;
                Storage::delete('public/' .$oldImage_name);
            }
            $image_name = uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $image_name);
            $data['image'] = $image_name;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('admin#detailPage')->with(['update' => 'Admin Information is updated']);
    }

    //direct admin list page
    public function listPage(){

        $admins = User::where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.adminList',compact('admins'));
    }

    //delete admin 
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'One admin is deleted !']);
    }

    //change role
    public function changeRole(Request $request){

        $data = $this->getRoleData($request);
        User::where('id',$request->id)->update($data);
        return response()->json(['status' => true ,'message' => 'change success'], 200);        
    }

    //get role data
    private function getRoleData($request){
        return [
            'role' => $request->role,
        ];
    }

    //direct dashboard
    public function dashboard(){

        $customer = User::where('role','user')->count();
        $order = Order::count();
        $orders = Order::get();

        $totalPrice = 0;
        foreach ($orders as $o) {
            $totalPrice += $o->total_price;
        };
    
        return view('admin.dashboard.home',compact('customer','order','totalPrice'));
    }
    
    //check password validation
    private function passwordValidationCheck($request){
/*
    1.all fields must be filled
    2.new pw must be greater than 6 
    3.new and confirm must be same
    4.old must be same with db_pw

*/
    Validator::make($request->all(),[
        'oldPassword' => 'required | min:6',
        'newPassword' => 'required | min:6',
        'confirmPassword' => 'required | min:6 | same:newPassword',
    ])->validate();
}

    //check personal validation
    private function personalValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ])->validate();
    }

    //get personal data
    private function getPersonalData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

}
