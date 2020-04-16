<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

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

    public function dadaa()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4)
        {
          $companies = DB::table('tb_companies')
            ->where('heseg_id','=',Auth::user()->heseg_id)
            ->get();
        }
        else{
          $companies = DB::table('tb_companies')->get();
        }
        return view('home', compact('companies'));
    }

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'),Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Таны хуучин нууц үг буруу байна.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Шинэ нууц үг болон давтаж хийсэн нууц үг хоорондоо таарахгүй байна.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Нууц үг солигдлоо !");
    }
}
