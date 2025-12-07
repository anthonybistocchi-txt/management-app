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

    public function execute(array $credentials, string $ip, bool $remember = false): bool
    {
        $throttleKey = Str::transliterate(Str::lower($credentials['email']) . '|' . $ip);

        $this->checkTooManyAttempts($throttleKey);

        if (! Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($throttleKey);
            
            throw ValidationException::withMessages([
                'email' => ['wrong credentials provided.'],
            ]);
        }

        RateLimiter::clear($throttleKey);

        Session::regenerate();

        $user = Auth::user();

        
        LoginActivities::where('user_id', $user->id)
            ->whereNull('logout_at')
            ->update(['logout_at' => now()]);

        
        LoginActivities::create([
            'user_id'    => $user->id,
            'ip_address' => $ip,
            'login_at'   => now(),
            
        ]);
        return true;
    }

    /**
     * Realiza o Logout.
     */
    public function logout(): bool
    {
        $user = Auth::user(); 

        if ($user) {
            LoginActivities::where('user_id', $user->id)
                ->whereNull('logout_at')
                ->update(['logout_at' => now()]);
        }

        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        return true;

    }

    /**
     * Verifica e lança exceção do Rate Limiter.
     */
    private function checkTooManyAttempts(string $key): void
    {
        if (! RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }
}