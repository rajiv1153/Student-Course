<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\subscription;
use DB;
use Illuminate\Support\Facades\Auth;

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
        $courses= course::orderBy('created_at','DESC')->get();
        $items=subscription::with('getCourse')->where('user_id',Auth::user()->id)->get();
        return view('home',compact('courses','items'));
    }

    public function adminHome()
    {
        $courses= course::orderBy('created_at','DESC')->get();
        return view('admin',compact('courses'));
    }
}
