<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use App\Models\TipoMascota;
use App\Models\Veterinario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (['Cédula de Ciudadanía', 'Tarjeta de Identidad', 'Cédula de Extranjería', 'Pasaporte'] as $tipo) {
            TipoDocumento::firstOrCreate(['nombre_tipo_documento' => $tipo]);
        }

        $tiposMascota = [
            ['nombre_tipo_mascota' => 'Perro', 'nombre_raza' => 'Golden Retriever'],
            ['nombre_tipo_mascota' => 'Perro', 'nombre_raza' => 'Labrador'],
            ['nombre_tipo_mascota' => 'Perro', 'nombre_raza' => 'Mestizo'],
            ['nombre_tipo_mascota' => 'Gato', 'nombre_raza' => 'Persa'],
            ['nombre_tipo_mascota' => 'Gato', 'nombre_raza' => 'Mestizo'],
            ['nombre_tipo_mascota' => 'Ave', 'nombre_raza' => 'Canario'],
            ['nombre_tipo_mascota' => 'Otro', 'nombre_raza' => 'Otro'],
        ];
        foreach ($tiposMascota as $tipo) {
            TipoMascota::firstOrCreate($tipo);
        }

        $veterinarios = [
            [
                'nombre_veterinario' => 'Laura',
                'apellido_veterinario' => 'Gómez',
                'num_documento_vet' => '1001001001',
                'num_tarjeta_profesional' => 'TP-0001',
                'email_veterinario' => 'laura.gomez@petplan.test',
                'num_contacto_veterinario' => '3001112233',
                'password' => Hash::make('veterinario123'),
            ],
            [
                'nombre_veterinario' => 'Andrés',
                'apellido_veterinario' => 'Ríos',
                'num_documento_vet' => '1001001002',
                'num_tarjeta_profesional' => 'TP-0002',
                'email_veterinario' => 'andres.rios@petplan.test',
                'num_contacto_veterinario' => '3004445566',
                'password' => Hash::make('veterinario123'),
            ],
        ];
        foreach ($veterinarios as $vet) {
            Veterinario::firstOrCreate(['num_documento_vet' => $vet['num_documento_vet']], $vet);
        }
    }
}
