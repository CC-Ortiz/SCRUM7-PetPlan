<?php

// app/Http/Controllers/Auth/PasswordRecoveryController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Models\User;

class pass_recoveryController extends Controller
{
    //Formulario de recuperación de contraseña
    public function create()
    {
        return view('pass_recovery');
    }

    //Creación del token y envío del correo con el enlace
    public function store(Request $request){
        $request->validate(['email' => ['required', 'email']]);
        Password::sendResetLink($request->only('email'));
        return back()->with('status', 'Si el correo está registrado, le enviaremos las instrucciones.');
    }

    //Formulario de contraseña nueva
    public function edit(Request $request, string $token){
        return view('pass-reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    //Verificación de token y actualización a contraseña nueva
    public function update(Request $request){
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $estado = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($usuario, $password){
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