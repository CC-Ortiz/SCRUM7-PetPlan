<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
        {
            ResetPassword::toMailUsing(function ($usuario, $token) {
                // Enlace que llega a tu ruta password.reset (token + correo)
                $url = url(route('password.reset', [
                    'token' => $token,
                    'email' => $usuario->getEmailForPasswordReset(),
                ], false));
    
                // Vigencia del enlace, tomada de config/auth.php
                $minutos = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
    
                return (new MailMessage)
                    ->subject('Recupera tu contraseña en PetPlan')
                    ->greeting('¡Hola!')
                    ->line('Hemos recibido una solicitud para restablecer la contraseña de su cuenta.')
                    ->action('Crear contraseña nueva', $url)
                    ->line("Este enlace vence en {$minutos} minutos.")
                    ->line('Si no fue usted, ignore este mensaje. Su contraseña no cambiará.')
                    ->salutation('El equipo de PetPlan');
            });
        }
}