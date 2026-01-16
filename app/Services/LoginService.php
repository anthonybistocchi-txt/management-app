<?php

namespace App\Services;

use App\Models\LoginActivities;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importação correta da Facade
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoginService
{
    /**
     * Executa o processo de login completo e atualiza a sessão.
     *
     * @param array $credentials
     * @param string $ip
     * @param bool $remember
     * @return bool
     * @throws ValidationException
     */

    public function login(array $credentials, string $ip): void
    {
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        Session::regenerate();

        Session::put([
            'login_ip'  => $ip,
            'login_at'  => now(),
        ]);


        LoginActivities::create([
            'user_id'    => Auth::id(),
            'ip_address' => $ip,
            'action'     => 'login',
            'action_at'  => now(),
        ]);
    }


    public function logout(): void
    {
        LoginActivities::create([
            'user_id'    => Auth::id(),
            'ip_address' => request()->ip(),
            'action'     => 'logout',
        ]);

        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
    }
}