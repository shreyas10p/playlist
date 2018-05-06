<?php

namespace App\Http\Controllers;
use View;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class HomeController extends BaseController
{
    public function showLogIn(Request $request) {
    	if ($request->session()->has('userId')) {
            return Redirect::to('dashboard');
		 } else{
            return view('login');
        }
    }

    public function doLogout(Request $request){
        $request->session()->flush();
            return Redirect::to('/');
    }

}
