<?php

namespace App\Http\Controllers;

use App\Models\Dueno;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegistro()
    {
        $tiposDocumento = TipoDocumento::orderBy('nombre_tipo_documento')->get();

        return view('registro', compact('tiposDocumento'));
    }

    public function registro(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:60'],
            'apellido' => ['required', 'string', 'max:45'],
            'email' => ['required', 'email', 'max:50', 'unique:duenos,email'],
            'num_contacto' => ['required', 'string', 'max:15', 'unique:duenos,num_contacto'],
            'num_documento' => ['required', 'string', 'max:15', 'unique:duenos,num_documento'],
            'tipo_documento_id' => ['nullable', Rule::exists('tipos_de_documento', 'id_tipo_documento')],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $duenos = Dueno::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'email' => $datos['email'],
            'num_contacto' => $datos['num_contacto'],
            'num_documento' => $datos['num_documento'],
            'tipo_documento_id' => $datos['tipo_documento_id'] ?? null,
            'password' => Hash::make($datos['password']),
        ]);

        Auth::guard('web')->login($duenos);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', 'Cuenta creada correctamente. ¡Bienvenido a PetPlan!');
    }

    public function showLogin()
    {
        return view('login');
    }

    /**
     * Login unificado: el mismo formulario sirve tanto para dueños como
     * para veterinarios. Se intenta autenticar contra cada guard hasta
     * que uno de los dos acepte las credenciales.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $recordarme = $request->boolean('remember');

        // 1) ¿Es un dueño de mascota?
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $recordarme)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // 2) ¿Es un veterinario?
        if (Auth::guard('veterinario')->attempt(['email_veterinario' => $request->email, 'password' => $request->password], $recordarme)) {
            $request->session()->regenerate();

            return redirect()->intended(route('veterinario.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Las credenciales no coinciden con ningún registro.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('veterinario')->check()) {
            Auth::guard('veterinario')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
