<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventsIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $id, $title, $max_quotas, $daysOfWeek, $startTime, $endTime, $color, $textColor, $eventId;


    public function render()
    {
        $events = Event::where('title', 'like', '%' . $this->search . '%')
            ->select('id', 'title', 'startTime', 'endTime', 'max_quotas', 'daysOfWeek')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $events->each(function ($event) {
            $event->daysOfWeek =  Carbon::create()->isoWeekday($event->daysOfWeek)->isoFormat('dddd');
        });

        return view('livewire.admin.events-index', compact('events'));
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->select('id', 'title', 'color', 'textColor', 'max_quotas', 'daysOfWeek', 'startTime', 'endTime')->first();
        $this->id = $event->id;
        $this->title = $event->title;
        $this->color = $event->color;
        $this->textColor = $event->textColor;
        $this->max_quotas = $event->max_quotas;
        $this->daysOfWeek = $event->daysOfWeek;
        $this->startTime = $event->startTime;
        $this->endTime = $event->endTime;
    }

    public function update($id)
    {
        $this->validate([
            'title' => 'required',
            'color' => 'required',
            'textColor' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'max_quotas' => 'required',
            'daysOfWeek' => 'required',
        ]);

        try {

            Event::where('id', $id)->update([
                'title' => $this->title,
                'color' => $this->color,
                'textColor' => $this->textColor,
                'daysOfWeek' => $this->daysOfWeek,
                'startTime' => $this->startTime,
                'endTime' => $this->endTime,
                'max_quotas' => $this->max_quotas,
            ]);

            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha actualizado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al actualizar un nuevo usuario']);
        }
    }

    public function confirmDestroy($id)
    {
        $this->eventId = $id;
        $this->dispatch('confirmDeleteAppointments', [
            'message' => '¿Estás seguro?',
            'confirmButtonText' => 'Sí, eliminarlo',
        ]);
    }


    public function destroy()
    {
        try {
            Event::where('id', $this->eventId)->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar el evento']);
        }
    }
}
