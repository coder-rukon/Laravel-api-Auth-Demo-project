<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    /*
   
    */
    //return __('passwords.password');
    return view('welcome');
})->middleware(['localize']);

//Auth::routes();

Route::group(['middleware' => ['web','localize']], function () {
    Route::get('/signin',"CustomAuth@Login")->name("login");
    Route::get('/logout', 'CustomAuth@Logout')->name('logout');
    Route::post('/signinRequest',"CustomAuth@LoginRequest")->name("loginRequest");
    Route::get('/signup',"CustomAuth@Register")->name("registerUrl");
    Route::post('/joinRequest',"CustomAuth@RequestRegister")->name("registRequest");
    Route::group([
        'middleware' => ["auth"]
    ],function(){
        Route::get('/dashboard',"Dashboard@index")->name("dasboard");
    });
});



/*

Route::get('lng/{name}',function($name){
    session([
        'rslng' => $name
    ]);
    return redirect()->back();
})->name("local");

*/