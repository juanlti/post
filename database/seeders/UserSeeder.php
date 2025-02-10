<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //credencial de acceso
        User::create([
            'name' => 'juan cruz',
            'email' => 'juancruzliberati@hotmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        //credenciales de prueba
        User::factory(99)->create();
    }
}
