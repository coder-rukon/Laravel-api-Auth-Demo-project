<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class Dashboard extends Controller
{
    public function index(){
        $viewData['user'] = Auth::user();
        return view('dashboard',$viewData);
    }
}
