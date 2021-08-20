<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');

    // }

    public function get_login()
    {
        return view('auth.login');
    }



   public function loginCheck(Request $request){
    //return $request;

    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required',  'min:5','max:12', ],
    ]);

    $userInfo=User::where('email','=', $request->email)->first();
    if(! $userInfo){//
        return back()->with('failLog', 'We do not recogonize your email address');
    }else{
        if(Hash::check($request->password, $userInfo->password))    {
            $request->session()->put('LoggedUser',$userInfo->id);


                    // Role Id Check
                    if($userInfo->role_id==1){
                        return redirect('admin');
                    }elseif($userInfo->role_id==2){
                        return redirect('student/dashboard');
                    }elseif($userInfo->role_id==3){
                        return redirect('teacher/dashboard');
                    }


        }else{
            return back()->with('failLog','incorret password');
        }
    }
}


    public function logout(){
        if(session()->has('LoggedUser')){
           // dd(session());
            session()->pull('LoggedUser');
            return redirect('/login');
        }
    }

}
