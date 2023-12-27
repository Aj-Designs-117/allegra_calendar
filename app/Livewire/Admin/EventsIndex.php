<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventsIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $id, $title, $start, $end, $limited_quotas, $daysOfWeek, $startTime, $endTime, $color, $textColor;


    public function render()
    {
        $events = Event::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orWhere('startTime', 'like', '%' . $this->search . '%')
            ->paginate(15);
        return view('livewire.admin.events-index', compact('events'));
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->select('id', 'title', 'color', 'textColor', 'start', 'end', 'limited_quotas', 'daysOfWeek', 'startTime', 'endTime')->first();
        $this->id = $event->id;
        $this->title = $event->title;
        $this->color = $event->color;
        $this->textColor = $event->textColor;
        $this->start = $event->start;
        $this->end = $event->end;
        $this->limited_quotas = $event->limited_quotas;
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
            'start' => 'required',
            'end' => 'required',
            'limited_quotas' => 'required'
        ]);

        try {

            Event::where('id', $id)->update([
                'title' => $this->title,
                'color' => $this->color,
                'textColor' => $this->textColor,
                'start' => $this->start,
                'end' => $this->end,
                'daysOfWeek' => $this->daysOfWeek,
                'startTime' => $this->startTime,
                'endTime' => $this->endTime,
                'limited_quotas' => $this->limited_quotas,
            ]);


            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha actualizado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al actualizar un nuevo usuario']);
        }
    }

    public function destroy($id)
    {
        try {
            Event::find($id)->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar el evento']);
        }
    }
}
