<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use App\Models\UserModules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulesController extends Controller
{
    //
    public function index(){
        $module=[];
        $usermod =UserModules::where('user_id',Auth::user()->id)->where('active',true)->with('user')->with('module')->get();
        foreach ($usermod as  $value) {
           $module[]=$value->module;
        }
        return response()->json($module,200);
    }

    public function indexall(){
        return response()->json(Modules::all(),200);
    }

    public function activatemodule($id){
        $mod=Modules::find($id);
        $user=Auth::user()->id;
        if(isset($mod)){
            $usermod =UserModules::where('user_id',$user)->where('module_id',$mod->id)->first();
            if(isset($usermod)){
                $usermod->active=true;
                
            }else{
                $usermod=new UserModules();
                $usermod->user_id= $user;
                $usermod->module_id=$mod->id;
                $usermod->active =true;
            }
            
            $usermod->save();
            return response()->json(["message"=>"Module activated"],200);
        }else{
            return response()->json(null,404);
        }
    }
    public function desactivemodule($id){
        $mod=Modules::find($id);
        if(isset($mod)){
            $user=Auth::user()->id;;
            $usermod =UserModules::where('user_id',$user)->where('module_id',$mod->id)->first();
            if(isset($usermod)){
                $usermod->active=false;
                
            }else{
                $usermod=new UserModules();
                $usermod->user_id= Auth::user()->id;
                $usermod->module_id=$mod->id;
                $usermod->active =false;
            }
            $usermod->save();
            return response()->json(["message"=>"Module deactivated"],200);
        }else{
            return response()->json(null,404);
        }
    }
}
