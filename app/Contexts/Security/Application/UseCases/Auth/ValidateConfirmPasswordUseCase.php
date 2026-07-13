<?php

namespace App\Contexts\Security\Application\UseCases\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ValidateConfirmPasswordUseCase
{
    public function execute(string $password, string $userEmail): void
    {
        if (! Auth::guard('web')->validate([
            'email'    => $userEmail,
            'password' => $password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session()->put('auth.password_confirmed_at', time());
    }
}