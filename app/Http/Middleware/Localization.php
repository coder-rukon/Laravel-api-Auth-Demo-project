<?php

namespace App\Http\Middleware;

use Closure;
use App;
class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setLocation();
        /*
        if($request->session()->has('rslng')){
            App::setLocale($request->session()->get('rslng') );
        }
        */
        

        return $next($request);
    }

    public function setLocation(){
        $ch = curl_init();
        $url = 'https://exercise.api.rebiton.com/language';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $resultObj = json_decode($result);
        if(isset($resultObj->data->language)){
            App::setLocale($resultObj->data->language);
        }
        
    }
}
