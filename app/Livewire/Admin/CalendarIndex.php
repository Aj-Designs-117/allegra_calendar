<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class CalendarIndex extends Component
{
    public function render()
    {

        $all_events = Event::all();
        $events = [];
        foreach ($all_events as $event) {
            $events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'color' => $event->color,
                'textColor' => $event->textColor,
                'start' => $event->start,
                'end' => $event->end,
                'daysOfWeek' => $event->daysOfWeek,
                'startTime' => $event->startTime,
                'endTime' => $event->endTime,
            ];
        }

        return view('livewire.admin.calendar-index', compact('events'));
    }
}
