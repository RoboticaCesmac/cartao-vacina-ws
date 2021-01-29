<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Usuario::create([
            'nome'      => 'admin',
            'email'     => 'admin@admin.com',
            'senha'     => bcrypt('123456'),
            'data_nascimento'   => '2000-01-01'
        ]);
    }
}
