<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $description, $name;

    public function render()
    {
        $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(15);
        return view('livewire.admin.permissions-index', compact('permissions'));
    }

    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
    }

    public function store()
    {

        $this->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        try {
            Permission::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->resetFields();
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo usuario']);
            $this->resetFields();
        }
    }
}
