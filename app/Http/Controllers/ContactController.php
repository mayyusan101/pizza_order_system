<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //direct User contact page
    public function contactPage(){

        return view('user.contact.contactPage');
    }

    //send contact form
    public function send(Request $request){

        Contact::create([
            'message' => $request->message,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('user#contactPage')->with(['message' => 'Your message is sent successfully']);
    }

    //direct Admin contact list page
     public function contactListPage(){

        if(request('searchKey')){
       
        $contacts = Contact::orWhere('contacts.name','like','%'.request('searchKey').'%') 
                            ->orWhere('contacts.message','like','%'.request('searchKey').'%')
                            ->orWhere('contacts.email','like','%'.request('searchKey').'%')    
                            ->orderBy('created_at','desc')
                            ->paginate(4);         
        return  view('admin.contact.list',compact('contacts'));
        }
        
        $contacts = Contact::orderBy('created_at','desc')
                            ->paginate(4);
        return view('admin.contact.list',compact('contacts'));
    }

    //delete
    public function delete($id){
        
        Contact::where('id',$id)->delete();
        return redirect()->back();
    }

    //direct contact detail page
    public function detailPage($id){

        $contact = Contact::find($id);
        return view('admin.contact.detail',compact('contact'));
    }

}
