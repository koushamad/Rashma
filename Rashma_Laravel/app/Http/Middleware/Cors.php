<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 7:15 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors {

    /**
     * CREATE CORS MIDDLEWARE
     *
     * @param $request
     * @param Closure $next
     *
     * @return Closure
     */

    public function handle($request, Closure $next)
    {

        if ($request->getMethod() === "OPTIONS") {
            return response()->json(['success'=>'ok'],Response::HTTP_OK)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Authorization');
        }

        $sAccept = $request->header('Accept');
        $aAccept = explode(',' , $sAccept);
        $bAcceptJson = false;
        foreach($aAccept as $accept){
            if($accept == 'application/json'){
                $bAcceptJson = true;
            }
        }
        if($bAcceptJson){
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Authorization');
        }else{
            return $next($request);
        }


    }

}
