<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Marks;
use App\Models\Result;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $usercount = User::count();
        $marksheetcount = Marks::count();
        $resultcount = Result::count();
        return view('dashboard',compact('usercount','marksheetcount','resultcount'));
    }

    public function logout()
{
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully.');
}


}
