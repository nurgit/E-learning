<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegistationController extends Controller
{
    public function registation(){
        return view('auth.register');
    }

    public function create(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5','max:12', ],
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $save=$user->save();
        
       


         if( $save  ){
          
            return back()->with('faillCreateOne' , 'something went wrong, please try agane later');
            
         }else{
        //     //return back()->with('success' , 'new user has been added successfully');
            
            return back()->with('faillCreateOne' , 'something went wrong, please try agane later');
         }
    }
    

}
