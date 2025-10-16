<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlShortener;
use Illuminate\Support\Facades\Auth;

class UrlShortnerController extends Controller
{
    //
    public function creatshortlink(Request $request){
      //  Body JSON : original_url (string, obligatoire), custom_code (string, optionnel, max 10 chars, unique)
      $canwrite =true;
      $request->validate([
        'original_url'=>['required','url'],
        'custom_code'=>['max:10']
      ]);
      
      if(isset($request->custom_code)){
        if(!preg_match('/^[\w\-\_]*$/',$request->custom_code)){
            $canwrite=false;
        }else{
            $check=UrlShortener::where('code',$request->custom_code)->first();
            if(isset($check)){
                $canwrite=false;
            }
        }
      }
      if($canwrite==true){
            $user=Auth::user()->id;
            $urlshort = new UrlShortener();
            $urlshort->original_url=$request->original_url;
            $urlshort->code=$request->code;
            $urlshort->user_id=$user;
            $urlshort->code=0;
      }else{
            return response()->json(null,400);
      }
        
    }
}
