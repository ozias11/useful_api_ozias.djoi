<?php

namespace App\Http\Middleware;

use App\Models\UserModules;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,int $id): Response
    {
        $user=Auth::user()->id;
        $usermod =UserModules::where('user_id',$user)->where('module_id',$id)->first();
        if(isset($usermod)){
            if($usermod->active==true){
                return $next($request);
            }
        }
        
        return response()->json(["error"=> "Module inactive. Please activate this module to use it."],403);
    }
}
