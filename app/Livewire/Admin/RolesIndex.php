<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    public $name;

    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.roles-index', compact('roles'));
    }

    public function resetFields()
    {
        $this->name = '';
    }


    public function store()
    {
        $this->validate(['name' => 'required|max:255']);

        try {
            $role = Role::create(['name' => $this->name]);

            $this->resetFields();
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo role']);
            $this->resetFields();
        }
    }
}
