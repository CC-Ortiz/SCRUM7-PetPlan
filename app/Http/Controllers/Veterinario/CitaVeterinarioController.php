<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CitaVeterinarioController extends Controller
{
    public function aceptar(Cita $cita)
    {
        $this->autorizarAcceso($cita);

        $cita->update(['confirmacion' => true]);

        return redirect()
            ->route('veterinario.dashboard')
            ->with('status', 'Cita confirmada. El dueño ya puede verla como confirmada.');
    }

    /**
     * Solo el veterinario asignado a la cita puede operar sobre ella.
     */
    private function autorizarAcceso(Cita $cita): void
    {
        $veterinario = Auth::guard('veterinario')->user();

        abort_unless(
            $cita->veterinarios()->where('veterinarios.id_veterinario', $veterinario->id_veterinario)->exists(),
            403,
            'No tienes permiso para gestionar esta cita.'
        );
    }
}
