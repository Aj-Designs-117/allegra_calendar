<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'description' => 'SuperAdmin',
            'price' => '000',
            'status' => 'Activo',
            'class_limit' => 500,
            'start_date' => '3000-12-25',
            'end_date' => '3000-12-25',
            'user_id' => '1',
        ]);

        Subscription::create([
            'description' => 'Administrador',
            'price' => '000',
            'status' => 'Activo',
            'class_limit' => 500,
            'start_date' => '3000-12-24',
            'end_date' => '3000-12-24',
            'user_id' => '2',
        ]);
    }
}
