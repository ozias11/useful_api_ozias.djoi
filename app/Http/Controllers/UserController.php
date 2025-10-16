<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','email','max:255','unique:users'],
            'password'=>['required','string','min:8','max:255']
        ]);
        
       $newuser= User::create($request->all());
       
        return response()->json(['id'=>$newuser->id,'name'=>$newuser->name,'email'=>$newuser->email,'created_at'=>date_format($newuser->created_at,'Y-m-d\TH:i:s\Z')],201);
    }

    public function connexion(Request $request){
        $credential = $request->validate([
            'email'=>['required','email'],
            'password'=>['required','string']
        ]);
        if(Auth::attempt($credential)){
            $token =$request->user()->createToken('token');
            return response()->json(['token'=>$token->plainTextToken,'user_id'=>Auth::user()->id],200);
        }else{
            return response()->json(null,401);
        }
    }
}
