<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DuenoResource;
use App\Http\Resources\VeterinarioResource;
use App\Models\Dueno;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * La API solo registra dueños de mascota (igual que el formulario web
     * público). Los veterinarios se dan de alta por otro medio.
     */
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

        $dueno = Dueno::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'email' => $datos['email'],
            'num_contacto' => $datos['num_contacto'],
            'num_documento' => $datos['num_documento'],
            'tipo_documento_id' => $datos['tipo_documento_id'] ?? null,
            'password' => Hash::make($datos['password']),
        ]);

        $token = $dueno->createToken('api-dueno', ['dueno'])->plainTextToken;

        return response()->json([
            'token' => $token,
            'tipo_usuario' => 'dueno',
            'usuario' => new DuenoResource($dueno),
        ], 201);
    }

    /**
     * Login unificado: intenta autenticar como dueño y, si no coincide,
     * como veterinario. Misma lógica que el login web, pero entregando
     * un token en vez de crear una sesión.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $dueno = Dueno::where('email', $request->email)->first();

        if ($dueno && Hash::check($request->password, $dueno->password)) {
            $token = $dueno->createToken('api-dueno', ['dueno'])->plainTextToken;

            return response()->json([
                'token' => $token,
                'tipo_usuario' => 'dueno',
                'usuario' => new DuenoResource($dueno),
            ]);
        }

        $veterinario = Veterinario::where('email_veterinario', $request->email)->first();

        if ($veterinario && Hash::check($request->password, $veterinario->password)) {
            $token = $veterinario->createToken('api-veterinario', ['veterinario'])->plainTextToken;

            return response()->json([
                'token' => $token,
                'tipo_usuario' => 'veterinario',
                'usuario' => new VeterinarioResource($veterinario),
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales no coinciden con ningún registro.'],
        ]);
    }

    public function me(Request $request)
    {
        $usuario = $request->user();

        if ($usuario instanceof Veterinario) {
            return response()->json([
                'tipo_usuario' => 'veterinario',
                'usuario' => new VeterinarioResource($usuario),
            ]);
        }

        return response()->json([
            'tipo_usuario' => 'dueno',
            'usuario' => new DuenoResource($usuario),
        ]);
    }

    public function logout(Request $request)
    {
        // Revoca solo el token usado en esta petición, no todos
        // los dispositivos donde la persona tenga sesión iniciada.
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }
}
