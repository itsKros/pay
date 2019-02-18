<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function editprofile(){
        return view('auth.editprofile');
    }

    public function changeDetails(Request $request){
        if($request->get('current-password') && $request->get('new-password') && $request->get('confirm-password')){
          if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
              return redirect('editprofile')->with("error","Your current password does not matches.");
          }

          if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
              return redirect('editprofile')->with("error","New Password cannot be same as current password.");
          }
        }
        $validatedData = $request->validate([
            'name' => '',
            'email' => '',
            'current-password' => 'bail',
            'new-password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect('editprofile')->with("success","Profile changed successfully !");
    }
}
