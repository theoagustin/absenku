<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Session;

class RedirectController extends Controller
{
    /**
     * index
     *
     * @return View
     */
	 
	 //return redirect()->to('http://heera.it');
    public function index()
    {
		if (Auth::check()) {
        //get posts
		$role=Auth::user()->role_level;
        if($role==1){
			
        return redirect('admin');
		}elseif($role==2){
        return redirect('perusahaan');
		}elseif($role==3){
			$absensi="";
            return redirect('absensi');
		}
		}else{
            return view('login');
        }
    }

}