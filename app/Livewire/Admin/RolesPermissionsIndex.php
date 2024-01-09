<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $id, $name, $selectedPermissions = [], $rolesPermissionsId;

    public function render()
    {
        $roles = Role::select('id', 'name')->get();
        $permissions = Permission::select('name', 'description')->get();
        return view('livewire.admin.roles-permissions-index', compact('roles', 'permissions'));
    }
    public function edit($id)
    {
        $role = Role::where('id', $id)->select('id', 'name')->firstOrFail();
        $this->id = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions()->pluck('name')->toArray();
    }


    public function update($id)
    {
        $this->validate(['name' => 'required|max:255']);

        try {
            $role = Role::find($id);

            if ($role) {
                $role->name = $this->name;
                $role->save();
                $role->syncPermissions($this->selectedPermissions);
                $this->dispatch('success', ['message' => 'Se ha actualizado correctamente']);
            } else {
                $this->dispatch('warning', ['message' => 'El rol y el permisos no fue encontrado']);
            }

            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al actualizar el nuevo role y permiso']);
        }
    }

    public function confirmDestroy($id)
    {
        $this->rolesPermissionsId = $id;
        $this->dispatch('confirmDeleteAppointments', [
            'message' => '¿Estás seguro?',
            'confirmButtonText' => 'Sí, eliminarlo',
        ]);
    }


    public function destroy()
    {
        try {
            Role::where('id', $this->rolesPermissionsId)->firstOrFail()->delete();
            $this->dispatch('success', ['message' => 'Se ha eliminado correctamente']);
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Algo va mal al eliminar el role']);
        }
    }
}
