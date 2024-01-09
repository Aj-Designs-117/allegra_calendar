<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AppointmentsHistory extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $records = Auth::user()->records()->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('date', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(15);

        return view('livewire.student.appointments-history', compact('records'));
    }
}
