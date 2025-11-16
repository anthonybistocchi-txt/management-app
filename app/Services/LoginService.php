<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function loginAttempt($data)
    {
        if (Auth::attempt($data)) {
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
