<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class EventsCreate extends Component
{
    public $title, $max_quotas, $daysOfWeek, $startTime, $endTime, $color, $textColor;

    public function render()
    {
        return view('livewire.admin.events-create');
    }

    public function resetFields()
    {
        $this->title = '';
        $this->startTime = '';
        $this->endTime = '';
        $this->max_quotas = '';
        $this->daysOfWeek = '';
    }

    public function store()
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
            $data = [
                'title' => $this->title,
                'color' => $this->color,
                'textColor' => $this->textColor,
                'daysOfWeek' => $this->daysOfWeek ?? null,
                'startTime' => $this->startTime ?? null,
                'endTime' => $this->endTime ?? null,
                'max_quotas' => $this->max_quotas,

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
