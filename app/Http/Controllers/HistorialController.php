<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $idsMascotas = Auth::user()->mascotas()->pluck('id_mascota');

        $historias = HistoriaClinica::with(['mascota', 'veterinarios'])
            ->whereIn('id_mascota', $idsMascotas)
            ->orderByDesc('fecha_registro')
            ->get();

        return view('historial', compact('historias'));
    }
}
