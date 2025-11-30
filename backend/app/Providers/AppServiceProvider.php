<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->bootModelsDefaults();

        $this->setEmailVerificationUrl();

        $this->setPasswordResetUrl();
    }

    private function bootModelsDefaults(): void
    {
        Model::unguard();
    }

    private function setEmailVerificationUrl(): void
    {
        VerifyEmail::createUrlUsing(function ($notifiable) {
            $signed = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            return config('app.frontend_url').'/verify-email?url='.urlencode($signed);
        });
    }

    private function setPasswordResetUrl(): void
    {
        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            return
                config('app.frontend_url').
                '/reset-password?token='.$token.
                '&email='.urlencode($notifiable->getEmailForPasswordReset());
        });
    }
}
