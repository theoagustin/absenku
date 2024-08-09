<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
		
        if(!$user)
        {
			$pass=rand(100000,999999);
            $user = User::create(['nama' => $googleUser->name, 'email' => $googleUser->email,'role_level' => '2','img_profile'=>$googleUser->picture, 'password' => \Hash::make($pass), 'pass_text' => $pass,'gauth_type'=> 'google', 'username' => ucwords(strtolower(str_replace(" ","",$googleUser->name)))]);
        }

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
		return redirect('redirect');
    }
}