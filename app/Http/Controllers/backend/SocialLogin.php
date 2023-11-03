<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    public function callback($driver)
    {
        $googleUser =  Socialite::driver($driver)->user();
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_token' => $googleUser->token,
            'profile_photo_path' => $googleUser->getAvatar(),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect('/user/dashboard');
    }
}
