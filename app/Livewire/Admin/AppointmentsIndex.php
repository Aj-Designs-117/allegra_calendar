<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class AppointmentsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $appointmentId;

    public function render()
    {
        $appointments = Appointment::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('date', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sort, $this->direction)
            // ->whereDate('date', Carbon::today())
            ->paginate(15);

        return view('livewire.admin.appointments-index', compact('appointments'));
    }

    public function confirmDestroy($id)
    {
        $this->appointmentId = $id;
        $this->dispatch('confirmDeleteAppointments', [
            'message' => '¿Estás seguro?',
            'confirmButtonText' => 'Sí, eliminarlo',
        ]);
    }

    public function destroy()
    {
        try {
            Appointment::where('id', $this->appointmentId)->firstOrFail()->delete();

            $this->dispatch('success', ['message' => 'Se ha borrado correctamente']);

        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al borrar']);
        }
    }
}
