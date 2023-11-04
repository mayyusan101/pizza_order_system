<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    //direct user list page
    public function userListPage(){
        
        $users = User::where('role','user')
                    ->orderBy('created_at','desc')
                    ->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    //change user role to admin
    public function changeRole(Request $request){

        $roleSource = [
            'role' => $request->role
        ];
        User::where('id',$request->id)->update($roleSource);
    }

    //delete user
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->back()->with(['deleteSuccess' => 'One user is delete!']);
    }
}
