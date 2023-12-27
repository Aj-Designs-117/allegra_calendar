<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Event;
use Livewire\WithPagination;
use Livewire\Component;

class AppointmentsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $appointments = Appointment::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('date', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sort, $this->direction)
            ->paginate(15);
        return view('livewire.admin.appointments-index', compact('appointments'));
    }

    public function destroy($id, $event_id)
    {
        try {
            $limited_quotas = Event::findOrFail($event_id);
            if ($limited_quotas) {
                $limited_quotas->update(['limited_quotas' => $limited_quotas->limited_quotas + 1]);
            }

            Appointment::find($id)->delete();
            return response()->json(['success' => 'Se ha borrado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo va mal al borrar']);
        }
    }
}
