<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Http\Request;

class EventsCreate extends Component
{
    public $title, $start, $end, $limited_quotas, $daysOfWeek, $startTime, $endTime, $color, $textColor;

    public function render()
    {
        return view('livewire.admin.events-create');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->start = '';
        $this->end = '';
    }

    public function store(Request $request)
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
            $data = [
                'title' => $this->title,
                'color' => $this->color,
                'textColor' => $this->textColor,
                'start' => $this->start,
                'end' => $this->end,
                'daysOfWeek' => $this->daysOfWeek ?? null,
                'startTime' => $this->startTime ?? null,
                'endTime' => $this->endTime ?? null,
                'limited_quotas' => $this->limited_quotas,

            ];
            Event::create($data);

            $this->resetFields();
            $this->dispatch('close-modal');
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo evento']);
            $this->resetFields();
        }
    }
}
