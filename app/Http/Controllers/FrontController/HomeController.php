<?php

namespace App\Http\Controllers\FrontController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontview.index');
    }
    public function aboutus()
    {
        return view('frontview.aboutus');
    }
    public function howitworks()
    {
        return view('frontview.howitworks');
    }
    public function contactus()
    {
        return view('frontview.contact');
    }
}
