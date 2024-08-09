<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Session;

class LoginApkController extends Controller
{
    public function loginapk()
    {
        if (Auth::check()) {
            return redirect('redirect');
        }else{
            return view('loginapk');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('redirect');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}