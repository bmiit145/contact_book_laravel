<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDetail;

class ConController extends Controller
{
    //

    public function view_con(Request  $request )
    {
        // $user = User::find(1);
        // $user = UserDetail::find(1);
        // dd($user->User->toArray());

        $contacts = Contact::where('user_id' , Auth::user()->id)->paginate(5);

        // $user = Auth::user();
        // $contacts = $user->contact;

        $count = intval($contacts->count()/5)+1;
        // dd(intval($count));
        $page = $request['page'];
        if (!$request['page']) {
            $page = 1;
        }
        return view('view_contact', compact('contacts', 'count' , 'page'));
    }

    public function add_con(Request $request){
        // dd($request->all());
        //for image
        $img_name = null;
        if ($request->file('image')) {
            $img_org_name = $request->file('image')->getClientOriginalName();
            $img_name = time().rand(1000,9999).$img_org_name;
            $request->file('image')->move('uploads/',$img_name);
        }
        
        
        $contact = new Contact;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->mo_no = $request->mo_no;
        $contact->image = $img_name;
        $contact->user_id = Auth::user()->id;
        $contact->save();
        
        return redirect('contact-list');
    }

    public function del_con(Request $request)
    {
       $del_id = $request->del_id;
       
       $contact = Contact::whereId($del_id);
       $contact->delete();
    }
    
}
