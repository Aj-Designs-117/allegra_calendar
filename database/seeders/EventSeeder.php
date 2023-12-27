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
            'start' => '2023-12-10 8:00:00',
            'end' => '2023-12-10 9:00:00',
            'daysOfWeek' => '1',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 9:00:00',
            'end' => '2023-12-14 10:00:00',
            'daysOfWeek' => '1',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 12,
            'original_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 17:00:00',
            'end' => '2023-12-10 18:00:00',
            'daysOfWeek' => '1',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 18:00:00',
            'end' => '2023-12-10 19:00:00',
            'daysOfWeek' => '1',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 19:00:00',
            'end' => '2023-12-10 20:00:00',
            'daysOfWeek' => '1',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Telas',
            'color' => '',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 8:00:00',
            'end' => '2023-12-10 9:00:00',
            'daysOfWeek' => '2',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'limited_quotas' => 8,
            'original_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 9:00:00',
            'end' => '2023-12-10 10:00:00',
            'daysOfWeek' => '2',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 17:00:00',
            'end' => '2023-12-10 18:00:00',
            'daysOfWeek' => '2',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'limited_quotas' => 8,
            'original_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 18:00:00',
            'end' => '2023-12-14 19:00:00',
            'daysOfWeek' => '2',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 12,
            'original_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Trapecio',
            'color' => '#2A1984',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 19:00:00',
            'end' => '2023-12-14 20:00:00',
            'daysOfWeek' => '2',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 20:00:00',
            'end' => '2023-12-10 21:00:00',
            'daysOfWeek' => '2',
            'startTime' => '20:00:00',
            'endTime' => '21:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 8:00:00',
            'end' => '2023-12-10 9:00:00',
            'daysOfWeek' => '3',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 9:00:00',
            'end' => '2023-12-10 10:00:00',
            'daysOfWeek' => '3',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 17:00:00',
            'end' => '2023-12-10 18:00:00',
            'daysOfWeek' => '3',
            'startTime' => '17:00:00',
            'endTime' => '18:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 18:00:00',
            'end' => '2023-12-10 19:00:00',
            'daysOfWeek' => '3',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 19:00:00',
            'end' => '2023-12-14 20:00:00',
            'daysOfWeek' => '3',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'limited_quotas' => 12,
            'original_quotas' => 12,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 8:00:00',
            'end' => '2023-12-10 9:00:00',
            'daysOfWeek' => '4',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 9:00:00',
            'end' => '2023-12-10 10:00:00',
            'daysOfWeek' => '4',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Péndulo',
            'color' => '#010101',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 17:00:00',
            'end' => '2023-12-10 18:00:00',
            'daysOfWeek' => '4',
            'startTime' => '17:00:00',
            'endTime' => '16:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 18:00:00',
            'end' => '2023-12-10 19:00:00',
            'daysOfWeek' => '4',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Telas',
            'color' => '',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 18:00:00',
            'end' => '2023-12-10 19:00:00',
            'daysOfWeek' => '4',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 8,
            'original_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 19:00:00',
            'end' => '2023-12-10 20:00:00',
            'daysOfWeek' => '4',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'limited_quotas' => 8,
            'original_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Aro',
            'color' => '#D0AE9E',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 8:00:00',
            'end' => '2023-12-10 9:00:00',
            'daysOfWeek' => '5',
            'startTime' => '8:00:00',
            'endTime' => '9:00:00',
            'limited_quotas' => 8,
            'original_quotas' => 8,
        ]);
        Event::create([
            'title' => 'Clases de Trapecio',
            'color' => '#2A1984',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 9:00:00',
            'end' => '2023-12-14 10:00:00',
            'daysOfWeek' => '5',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 4,
            'original_quotas' => 4,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 18:00:00',
            'end' => '2023-12-10 19:00:00',
            'daysOfWeek' => '5',
            'startTime' => '18:00:00',
            'endTime' => '19:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 19:00:00',
            'end' => '2023-12-10 20:00:00',
            'daysOfWeek' => '5',
            'startTime' => '19:00:00',
            'endTime' => '20:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Pole',
            'color' => '#F9A8D4',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-10 9:00:00',
            'end' => '2023-12-10 10:00:00',
            'daysOfWeek' => '6',
            'startTime' => '9:00:00',
            'endTime' => '10:00:00',
            'limited_quotas' => 6,
            'original_quotas' => 6,
        ]);
        Event::create([
            'title' => 'Clases de Stretching',
            'color' => '#B5C345',
            'textColor' => '#FFFFFF',
            'start' => '2023-12-14 10:00:00',
            'end' => '2023-12-14 11:00:00',
            'daysOfWeek' => '6',
            'startTime' => '10:00:00',
            'endTime' => '11:00:00',
            'limited_quotas' => 12,
            'original_quotas' => 12,
        ]);
    }
}
