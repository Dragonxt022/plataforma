<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UsersTableSeeder::class);
        // \App\Models\User::factory(5)->create();

        // Chama o seeder de Inscricoes
        $this->call(InscricoesSeeder::class);
    }
}
