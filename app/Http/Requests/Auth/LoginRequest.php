<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Always true — any visitor is allowed to attempt login.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for login request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the provided credentials.
     *
     * Uses Laravel's Auth::attempt() and applies rate limiting.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // Check rate-limiting before attempting login
        $this->ensureIsNotRateLimited();

        // Attempt login using the email/password pair
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            // Increase the failed-login counter for rate limiting
            RateLimiter::hit($this->throttleKey());

            // Return a validation error to the user
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Successful login — reset rate limiter counter
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the user has not exceeded the rate limit.
     * Allows max 5 attempts before temporary lockout.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // If attempts < limit → allow the request
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // Trigger lockout event (can be logged or handled)
        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Throw an error showing the remaining wait time
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Generate a unique rate-limiting key for this login request.
     * Combines the email + client IP (per-user-per-IP rate limiting).
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}