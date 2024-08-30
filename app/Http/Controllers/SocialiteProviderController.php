<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteProviderController extends Controller
{
    public function login($provider)
    {
        try {
            $redirect = Socialite::driver($provider)->redirect();
        } catch (Throwable $throwable) {
            return redirect()->back()->with('message', $throwable->getMessage());
        }

        return $redirect;
    }

    public function redirect($provider)
    {
        try {
            $githubUser = Socialite::driver($provider)->user();

            $user = User::updateOrCreate([
                'email' => $githubUser->email,
            ], [
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);

            Auth::login($user);

        } catch (Throwable $throwable) {
            return redirect()->back()->with('message', $throwable->getMessage());
        }

        return redirect('/dashboard');
    }
}
