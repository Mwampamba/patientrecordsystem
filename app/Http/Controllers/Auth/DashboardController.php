<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $title = [
            'title' => 'Dashboard'
        ]; 
        return view('dashboard', $title);
    } 

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }


}
