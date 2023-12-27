<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'AdminDev',
            'email' => 'dev@allegra.com',
            'password' => bcrypt('231244'),
        ])->assignRole('DevAdministrador');
        
        User::create([
            'name' => 'Allegra',
            'email' => 'admin@allegra.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('Administrador');
        // User::factory(15)->create();
    }
}
