<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsCreate extends Component
{
    public $name, $selectedPermissions = [];

    public function render()
    {
        $permissions = Permission::select('name', 'description')->get();
        return view('livewire.admin.roles-permissions-create', compact('permissions'));
    }

    public function resetFields()
    {
        $this->name = '';
    }


    public function store()
    {
        $this->validate([
            'name' => 'required|max:255',
            'selectedPermissions' => 'required'
        ]);

        try {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);

            $this->reset(['name', 'selectedPermissions']);
            $this->resetFields();
            $this->dispatch('success', ['message' => 'Se ha guardado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al crear un nuevo role']);
            $this->resetFields();
        }
    }
}
