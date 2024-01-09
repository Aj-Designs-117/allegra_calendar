<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'email_verified_at' => now(),
            'password' => bcrypt('231244'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,         

        ])->assignRole('DevAdministrador');
        
        User::create([
            'name' => 'Allegra',
            'email' => 'admin@allegra.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,  
        ])->assignRole('Administrador');
        // User::factory(5)->create();
    }
}
