<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModules;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    //
    public function index(){
        $user=Auth::user()->id;
        $wall=Wallet::where('user_id',$user)->first();
        if(!isset($wall)){
            $wall =new Wallet();
            $wall->user_id=$user;
            $wall->balance=100.50;
            $wall->save();  
        }
        return response()->json(['user_id'=>$wall->user_id,'balance'=>number_format($wall->balance,2)],200);
    }

    public function transfert(Request $request){
        $canwrite=true;
        $user=Auth::user()->id;
        $request->validate([
            'receiver_id'=>['required',"int"],
            'amount'=>['required','string']
        ]);
        if($request->amount<0){
            $canwrite=false;
        }
        if(preg_grep('/^[\d\.\,]*$/',$request->amount)){
            return response()->json(null,400);
        }
        $receveuser = User::find($request->receiver_id)->first();
        if(isset($receveuser) && $receveuser->id != $user){
            $check= UserModules::where('user_id',$receveuser->id)->where('module_id',2)->where('active',true)->first();
            if(isset($check)){
                
            }else{
                return response()->json(null,401);
            }
        }else{
            return response()->json(null,401);
        }
        return response()->json(['message'=>'everything is ok']);
    }
}