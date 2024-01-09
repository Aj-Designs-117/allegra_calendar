<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'daysOfWeek' => '1',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '1',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '1',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '1',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '1',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Telas',
            'color' => '',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'max_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'max_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Trapecio',
            'color' => '#2A1984',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '2',
            'startTime' => '20:00:00',
            'endTime' => '21:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '3',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '3',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '3',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '3',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '3',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'max_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '17:00:00',
            'endTime' => '16:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Telas',
            'color' => '',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '4',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'max_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '5',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'max_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Trapecio',
            'color' => '#2A1984',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '5',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '5',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '5',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '6',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'max_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'daysOfWeek' => '6',
            'startTime' => '10:00:00',
            'endTime' => '11:00:00',
            'max_quotas' => 12,
        ]);
    }
}
