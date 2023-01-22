<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      

       /*  //without session
        $lang = $request->segment(1);
        if($lang == 'en' || $lang == 'ar' ){
            App::setLocale($lang);
        }else{
            abort(404);
        }

        URL::defaults(['locale'=> app()->getLocale()]);*/
        return $next($request);
    }
}
