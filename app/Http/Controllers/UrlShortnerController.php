<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlShortener;
use DateTime;
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
            if(isset($request->custom_code)){
                $urlshort->code=$request->custom_code;
            }else{
                $chaine="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_1234567890";
                $coderand='';
                for($i=0;$i<10;$i++){
                    $coderand.=substr($chaine,random_int(0,strlen($chaine)-1),1);
                }
                $urlshort->code=$coderand;
            }
            $urlshort->user_id=$user;
            $urlshort->clicks=0;
            $urlshort->save();
           
            return response()->json(['id'=>$urlshort->id, "user_id"=>$urlshort->user_id,'original_url'=>$urlshort->original_url,'code'=>$urlshort->code,
            'clicks'=>$urlshort->clicks,'created_at'=>date_format($urlshort->created_at,'Y-m-d\TH:i:s\Z')],201);
        }else{
            return response()->json(null,400);
        }
        
    }

    public function getlink(){
        return response()->json(UrlShortener::where('user_id',Auth::user()->id)->get(),200) ;
    }

    public function deletelink($id){
        $urlshort= UrlShortener::find($id);
        
        if(isset($urlshort)){
            if($urlshort->user_id==Auth::user()->id){
                $urlshort->delete();
                return response()->json(["message"=>"Link deleted successfully" ],200);
            }
        }else{
            return response()->json(null,404);
        }
       
    }

    public function checkandredirect($code){
       $urlshort= UrlShortener::where('code',$code)->first();
       if(isset($urlshort)){
            $urlshort->clicks=$urlshort->clicks+1;
            $urlshort->save();
            return redirect()->away($urlshort->original_url,302);
       }else{
            return response()->json(null,404);
        }
    }
}
