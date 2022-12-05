<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(15)->create();

        \App\Models\User::factory()->create([
            'name' => 'Jonhatan Jacob Higuera Camacho',
            'email' => 'jonhatan.higuera5180@alumnos.udg.mx',
            'password' => '$2y$10$Vvjco55nc4zHvdvFLyWCReXSo31BhJ0XtviPlj4Y5hpN282HVjIVq',
            'is_admin' => '1',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Jonhatan Jacob Higuera Camacho',
            'email' => 'jonhatan.higuera5180@alumnos.udg.mx',
            'password' => '$2y$10$Vvjco55nc4zHvdvFLyWCReXSo31BhJ0XtviPlj4Y5hpN282HVjIVq',
            'is_admin' => '1',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Pepe Martinez Martinez',
            'email' => 'pepe@gmail.com',
            'password' => '$2y$10$Vvjco55nc4zHvdvFLyWCReXSo31BhJ0XtviPlj4Y5hpN282HVjIVq',
        ]);
    }
}
