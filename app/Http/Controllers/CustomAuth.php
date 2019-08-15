<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Session;
class CustomAuth extends Controller
{
    public function Index(){

    }
    public function Login()
    {
        return view('login');
    }
    public function LoginRequest(Request $request)
    {
        $request->validate(
            [
                "email" => "required",
                "password" => "required|min:6|max:255"
            ]
        );
        $params = array(
            'email' =>  $request->input('email'),
            'password' => $request->input('password'),//,Hash::make($request->input('password')),
        );
        $isUserLogin = Auth::attempt($params);
        if ($isUserLogin){
            return redirect()->intended('dashboard');
        }else{
            return Redirect::back();
        }
       

    }
    public function Register()
    {
        return view('register');
    }

    public function RequestRegister(Request $request)
    {
        $request->validate(
            [
                "email" => "required",
                "password" => "required|confirmed|min:6|max:255",
                "tc" => "required",
            ]
        );


        $url = 'https://exercise.api.rebiton.com/auth/register';

        $params = array(
            'code' => 'RBT092WPXGE41F02QMJ97APC9Z3E',
            'email' =>  $request->input('email'),
            'password' => $request->input('password'),//Hash::make($request->input('password')),
            'agreement' => ($request->input('tc') ? true : false),
        );


        $urlData = json_encode($params);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($urlData))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $resultObj = json_decode($result);

        if(isset($resultObj->errors)){
            $errorMessage = [];
            foreach($resultObj->errors as $errorKey => $errorLabel){
                foreach ($errorLabel as $key => $value) {
                    $errorMessage[] = $errorLabel;
                }
            }
            return Redirect::back()->withErrors($errorMessage);
        }else{
            return Redirect::back()->with("registration_success","Registration Success. Please login.");
        }

    }

    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to( url()->route('login'));
    }
}
