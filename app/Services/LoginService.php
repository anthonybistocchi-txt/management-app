<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function loginAttempt(Request $data)
    {
        $credentials = $data->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|max:200',
        ]);

        if (Auth::attempt($credentials)) {
            $data->session()->regenerate();

            return true;
        }

        return false;
    }


    public function logout(Request $data): void
    {
        Auth::logout();

        $data->session()->invalidate();
        $data->session()->regenerateToken();
    }
}
