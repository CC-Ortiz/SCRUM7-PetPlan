<?php

// app/Http/Controllers/Auth/PasswordRecoveryController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class pass_recoveryController extends Controller
{
    // 1. Formulario donde el usuario escribe su correo
    public function create()
    {
        return view('auth.recuperar-password');
    }

    // 2. Crea el token y envía el correo con el enlace
    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        Password::sendResetLink($request->only('email'));

        // Mismo mensaje exista o no la cuenta, para no revelar qué correos están registrados
        return back()->with('status', 'Si el correo está registrado, te enviamos las instrucciones.');
    }

    // 3. Formulario de contraseña nueva (se abre desde el enlace del correo)
    public function edit(Request $request, string $token)
    {
        return view('auth.pass-recovery', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // 4. Verifica el token y guarda la contraseña nueva
    public function update(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $estado = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($usuario, $password) {
                $usuario->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($usuario));
            }
        );

        if ($estado === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with('status', 'Tu contraseña fue actualizada. Ya puedes iniciar sesión.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'El enlace no es válido o ya venció. Solicita uno nuevo.']);
    }
}
