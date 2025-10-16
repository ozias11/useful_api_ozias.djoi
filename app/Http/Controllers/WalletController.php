<?php

namespace App\Http\Controllers;

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
}
