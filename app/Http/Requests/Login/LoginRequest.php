<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa e prepara os dados antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            // Converte para minúsculo e remove espaços antes e depois
            'email' => Str::lower(trim($this->input('email'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Usar array [] ao invés de pipe | é considerado mais limpo e seguro para regex
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:200'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'The email field is required.',
            'email.email'       => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min'      => 'The password must be at least :min characters.',
        ];
    }

    /**
     * Opcional: Verifica se o usuário tentou logar muitas vezes errado.
     * Você pode chamar esse método $request->authenticate() no Controller.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Cria uma chave única para o Rate Limiter baseada no IP e Email.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}