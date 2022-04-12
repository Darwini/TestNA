<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'slug_name' => 'administrador',
            'status'=> 1,
        ]);

        DB::table('roles')->insert([
            'name' => 'abg',
            'slug_name' => 'abogados',
            'status'=> 1,
        ]);
    }
}
