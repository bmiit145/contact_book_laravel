<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function createUser(Request $request)
    {
        $request->all();
        // $data = [
        //     'email' =>  $request->email,
        //     'password' => $request->password,
        // ];

        // DB::table('users')->insert($data);

        $User = new User;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();
        
        return Response()->json(['status' => true]);
    }

    public function login_page()
    {
        return view('index');
    }

    public function loginUser(Request $request)
    {
        $email =  $request->email;
        $password = $request->password;
        // $user = User::where('email', $email)->where('password', $password)->first();
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password , $user->password)) {
            Auth::login($user);
            return Response()->json(['status' => true]);
            // return redirect('contact-list');
        } else {
            return Response()->json(['status' => false]);
            // return redirect('/')->with('danger', 'User does not exits');
        }
    }

        public function api(){
            return Http::get('https://jsonplaceholder.typicode.com/comments');
        }
    
        public function logout()
        {
            Auth::logout();
            return redirect('/');
        }
}
