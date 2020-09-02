<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SocialAccountService;
use Socialite;


class SocialAuthController extends Controller
{
    public function redirectToProvider($provider) {

        return Socialite:: driver($provider)->redirect();
    }

    public function handleProviderCallback(SocialAccountService $service, $provider) {

        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);

        Auth::login($user);
        
        return redirect('/');
    }   
}
