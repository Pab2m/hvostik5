<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ad = AdController::IndexAd(1);
      $user  = Auth::user();
      return view('index', array('ad_all'=>$ad, 'user'=> $user, 'title_content'=>'Все объявления'));
    }
}
