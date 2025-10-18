<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function attempt(array $credentials): bool
    {

        if (Auth::attempt($credentials)) {
            // (Opcional) Regenera a sessão por segurança
            request()->session()->regenerate();
            return true;
        }

        return false;
    }
}
