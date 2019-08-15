<?php

namespace App\Providers;
use Session;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\ApiUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ApiAuthProvider implements  UserProvider 
{
    
    public function retrieveById($identifier){
        return session("api_user");
    }
    
    public function retrieveByToken($identifier, $token){
        $url = 'https://exercise.api.rebiton.com/user';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token
            )
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $resultObj = json_decode($result,true);

        if(isset($resultObj['data'])){
            $userAttr = $resultObj['data'];
            $userAttr['name'] = $userAttr['email'];
            return new ApiUser($userAttr);
        }else{
            return null;
        }
    }
    public function updateRememberToken(Authenticatable $user, $token){}
    public function retrieveByCredentials(array $credentials){
        $url = 'https://exercise.api.rebiton.com/auth/login';
        
        $params = array(
            'email' =>  $credentials['email'],
            'password' => $credentials['password'],//,Hash::make($request->input('password')),
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
            Session::flash('messages', $errorMessage); 
            return null;
        }elseif(isset($resultObj->data)){
            $user = $this->retrieveByToken(null,$resultObj->data->token);
            session()->put("api_user",$user);
            return $user;
        }else{
            return null;
        }
    }
    public function validateCredentials(Authenticatable $user, array $credentials){
        return true;
    }


}