<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@libreapp.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        foreach (['Novela', 'Ciencia', 'Historia', 'Tecnología'] as $nombre) {
            Category::firstOrCreate(
                ['slug' => Str::slug($nombre)],
                ['name' => $nombre]
            );
        }
    }
}
