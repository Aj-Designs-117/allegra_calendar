<?php

namespace Database\Seeders;

use App\Models\Package;
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
        Package::create([
            'description' => 'Administrador',
            'price' => '000',
            'class' => 500,
        ]);

        Package::create([
            'description' => 'Paquete de 6 clases',
            'price' => '380',
            'class' => 6,
        ]);

        Package::create([
            'description' => 'Paquete de 8 clases',
            'price' => '450',
            'class' => 8,
        ]);

        Package::create([
            'description' => 'Paquete de 10 clases',
            'price' => '500',
            'class' => 10,
        ]);

        Package::create([
            'description' => 'Paquete de 12 clases',
            'price' => '550',
            'class' => 12,
        ]);

        Package::create([
            'description' => 'Paquete de 14 clases',
            'price' => '600',
            'class' => 14,
        ]);

        Package::create([
            'description' => 'Paquete de 16 clases',
            'price' => '650',
            'class' => 16,
        ]);

        Package::create([
            'description' => 'Paquete de 18 clases',
            'price' => '700',
            'class' => 18,
        ]);

        Package::create([
            'description' => 'Paquete de 20 clases',
            'price' => '750',
            'class' => 20,
        ]);

        Package::create([
            'description' => 'Paquete ilimitado',
            'price' => '950',
            'class' => 30,
        ]);

        Subscription::create([
            'status' => 'Activo',
            'limit_class' =>500,
            'start_date' => '3000-12-25',
            'end_date' => '3000-12-25',
            'user_id' => '1',
            'package_id' => '1',
        ]);

        Subscription::create([
            'status' => 'Activo',
            'limit_class' =>500,
            'start_date' => '3000-12-24',
            'end_date' => '3000-12-24',
            'user_id' => '2',
            'package_id' => '1',
        ]);
    }
}
