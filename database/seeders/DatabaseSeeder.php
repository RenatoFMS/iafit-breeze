<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@iafit.com'],
            [
                'name' => 'Administrador IAFit',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            ExercicioSeeder::class,
        ]);
    }
}