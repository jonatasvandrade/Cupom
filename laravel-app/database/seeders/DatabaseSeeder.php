<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Cria usuário padrão
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Chama os seeders de produtos e cupons
        $this->call([
            ProdutoSeeder::class,
            CupomSeeder::class,
        ]);
    }
}
