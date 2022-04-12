<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paquetes')->insert([
            'nombre' => 'Basico',
            'descripcion' => 'Paquete básico y economico',
            'status'=> 1,
        ]);

        DB::table('paquetes')->insert([
            'nombre' => 'Pro',
            'descripcion' => 'Paquete profesional, bueno para muchas cosas',
            'status'=> 1,
        ]);

        DB::table('paquetes')->insert([
            'nombre' => 'Full',
            'descripcion' => 'Paquete completo con todas las opciones disponibles',
            'status'=> 1,
        ]);
    }
}
